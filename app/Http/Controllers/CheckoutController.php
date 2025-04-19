<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        // Get cart items
        $cartItems = [];
        $total = 0;

        if (Auth::check()) {
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
            $total = 0;
            foreach ($cartItems as $item) {
                if ($item->product) {
                    $total += $item->product->price * $item->quantity;
                }
            }
        } elseif (session()->has('cart')) {
            $sessionCart = session()->get('cart');
            // Process session cart items if needed
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Store a new order.
     */
    public function store(Request $request)
    {

        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'order_notes' => 'nullable|string',
            'shipping_method' => 'nullable|string',
            'payment_method' => 'required|string',
            'terms_condition' => 'required|accepted',
        ]);

        // Initialize values
        $userId = Auth::id();
        $shippingCost = 0;

        // Calculate shipping cost based on method
        if ($request->input('shipping_method') === 'flat') {
            $shippingCost = 50;
        }

        try {
            DB::beginTransaction();

            // Get cart items - handle both logged-in and guest users
            $cartItems = [];
            $subtotal = 0;

            // Get user ID or guest ID for cart lookup
            $cartUserId = session('user_id') ?? session('guest_user_id');

            $cartItems = CartItem::where('user_id', $cartUserId)->with('product')->get();

            foreach ($cartItems as $item) {
                if ($item->product) {
                    $subtotal += $item->product->price * $item->quantity;
                }
            }

            // Calculate tax (assuming 10% for this example)
            $tax = $subtotal * 0.10;

            // Calculate total
            $total = $subtotal + $shippingCost + $tax;

            // Create a new order
            $order = Order::create([
                'user_id' => $userId, // This will be NULL for guest users
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'company_name' => $request->input('company_name'),
                'country' => $request->input('country'),
                'street_address' => $request->input('street_address'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'order_notes' => $request->input('order_notes'),
                'shipping_method' => $request->input('shipping_method', 'free_shipping'),
                'payment_method' => $request->input('payment_method'),
                'different_shipping' => $request->has('different_shipping'),
                'shipping_first_name' => $request->input('shipping_first_name'),
                'shipping_last_name' => $request->input('shipping_last_name'),
                'shipping_company_name' => $request->input('shipping_company_name'),
                'shipping_country' => $request->input('shipping_country'),
                'shipping_street_address' => $request->input('shipping_street_address'),
                'shipping_apartment' => $request->input('shipping_apartment'),
                'shipping_city' => $request->input('shipping_city'),
                'shipping_state' => $request->input('shipping_state'),
                'shipping_zip_code' => $request->input('shipping_zip_code'),
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Add order items
            foreach ($cartItems as $item) {
                if ($item->product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->product_name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'color' => $item->color,
                        'size' => $item->size,
                    ]);
                }
            }

            // Clear the cart
            CartItem::where('user_id', $cartUserId)->delete();

            // Clear the guest user ID if present
            if (session()->has('guest_user_id')) {
                session()->forget('guest_user_id');
            }

            DB::commit();

            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'There was an error processing your order: ' . $e->getMessage());
        }
    }

    /**
     * Display the order confirmation page.
     */
    public function confirmation(Order $order)
    {
        // Check if the order belongs to the authenticated user (if logged in)
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Load the order items
        $order->load('items');

        return view('order-confirmation', compact('order'));
    }
}
