<?php

namespace App\Http\Controllers;

use App\Models\IProductColor;
use App\Models\IProductSize;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\IProduct;
use App\Models\Category;
use App\Models\CartItem;
class SiteController extends Controller
{
    public function index()
    {
        // if (!Session::has('user_id')) {
        //     return redirect()->route('signup');
        // }
        return view('index');
    }

    public function signup()
    {
        return view('signup');
    }

    public function login()
    {
        return view('login');
    }

    public function saveSignup(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Email already exists!');
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user = User::create($data);

        session()->put('user_id', $user->id);
        session()->put('first_name', $request->first_name);
        session()->put('last_name', $request->last_name);
        session()->put('email', $request->email);
        session()->put('logged_in', true);

        return redirect()->route('index')->with('success', 'Account created successfully');
    }

    public function processLogin(Request $request)
    {
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            $user = Auth::user();
            
            // Set up session variables
            session()->put('user_id', $user->id);
            session()->put('first_name', $user->first_name);
            session()->put('last_name', $user->last_name);
            session()->put('email', $user->email);
            session()->put('logged_in', true);
            
            // Regenerate session for security
            session()->regenerate();

            // Check if the user is admin and redirect accordingly
            if ($user->email === 'admin@gmail.com') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome to admin dashboard');
            } else {
                return redirect()->route('index')->with('success', 'Login successful');
            }
        }
        
        // Authentication failed
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        // Clear Laravel authentication
        Auth::logout();
        
        // Clear all session data
        session()->forget(['user_id', 'first_name', 'last_name', 'email', 'logged_in']);
        session()->flush();
        
        // Regenerate the session ID for security
        session()->regenerate(true);
        
        return redirect()->route('login')->with('success', 'You have been logged out successfully');
    }

    public function shop()
    {
        return view('shop');
    }

    public function collection()
    {
        return view('collection');
    }

    public function product()
    {
        $products = IProduct::with(['category', 'color', 'productImages'])->get();
        // Get unique categories for the filter
        $categories = Category::select('id', 'category_name')->get();

        return view('product', compact('products', 'categories'));
    }

    public function productDetails($id)
    {
        $product = IProduct::with(['category', 'color', 'productImages'])->findOrFail($id);  // This will automatically throw a 404 if product not found

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found');
        }

        return view('product_details', compact('product'));
    }

    // public function cart()
    // {
    //     $products = Product::all();
    //     return view('cart', compact('products'));
    // }
    public function addToCart(Request $request, $id)
    {
        $product = IProduct::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Check if user is logged in (user_id exists in session)
        $userId = session('user_id');
        
        // If user is not logged in, generate a guest ID for their cart
        if (!$userId) {
            if (!session()->has('guest_user_id')) {
                // Generate a unique guest ID if not already set
                session()->put('guest_user_id', 'guest_' . uniqid());
            }
            $userId = session('guest_user_id');
        }

        $cartItem = CartItem::create([
            'user_id' => $userId,
            'product_id' => $id,
            'name' => $product->product_name,
            'color' => $request->color,
            'size' => $request->size,
            'quantity' => $request->quantity ?? 1
        ]);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully');
    }

    public function cart()
    {
        // Get user ID or guest ID
        $userId = session('user_id') ?? session('guest_user_id');
        
        $cartItems = CartItem::where('user_id', $userId)
            ->get();

        // Get all product IDs from cart
        $productIds = $cartItems->pluck('product_id')->toArray();

        // Fetch product details for all products in cart
        $products = IProduct::with(['category', 'colors', 'sizes', 'productImages'])
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id'); // index by product ID for easy lookup

        return view('cart', compact('cartItems', 'products'));
    }

    public function removeFromCart($id)
    {
        // Get user ID or guest ID
        $userId = session('user_id') ?? session('guest_user_id');
        
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart');
    }

    public function emptyCart()
    {
        // Get user ID or guest ID
        $userId = session('user_id') ?? session('guest_user_id');
        
        CartItem::where('user_id', $userId)->delete();
        return redirect()->route('cart');
    }

    public function checkout()
    {
        // Get user ID or guest ID
        $userId = session('user_id') ?? session('guest_user_id');
        
        $cartItems = CartItem::where('user_id', $userId)->get();
        $products = IProduct::with(['category', 'colors', 'sizes', 'productImages'])
            ->whereIn('id', $cartItems->pluck('product_id')->toArray())
            ->get()
            ->keyBy('id');
        $total = $cartItems->sum(function($item) { return $item->product?->price * $item->quantity; });
        return view('checkout', compact('cartItems', 'products', 'total'));
    }
}
