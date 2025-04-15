<?php

namespace App\Http\Controllers;

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
        $user = User::where('email', $request->email)->first();
        if (!$user || !Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        session()->put('user_id', $user->id);
        session()->put('first_name', $user->first_name);
        session()->put('last_name', $user->last_name);
        session()->put('email', $user->email);
        session()->put('logged_in', true);

        return redirect()->route('index')->with('success', 'Login successful');
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
        $products = IProduct::with(['category', 'color', 'size', 'productImages'])->get();
        // Get unique categories for the filter
        $categories = Category::select('id', 'category_name')->get();

        return view('product', compact('products', 'categories'));
    }

    public function productDetails($id)
    {
        $product = IProduct::with(['category', 'color', 'size', 'productImages'])->findOrFail($id);  // This will automatically throw a 404 if product not found
        
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
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $product = IProduct::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cartItem = CartItem::create([
            'user_id' => session('user_id'),
            'product_id' => $id,
            'name' => $product->product_name,
            'color' => $product->color ? $product->color->color_name : null,
            'size' => $product->size ? $product->size->size_name : null,
            'quantity' => $request->quantity ?? 1
        ]);
        
        return redirect()->route('cart')->with('success', 'Product added to cart successfully');
    }

    public function cart()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Please login to view cart');
        }

        $cartItems = CartItem::where('user_id', session('user_id'))
                            ->get();

        // Get all product IDs from cart
        $productIds = $cartItems->pluck('product_id')->toArray();
        
        // Fetch product details for all products in cart
        $products = IProduct::with(['category', 'color', 'size', 'productImages'])
                           ->whereIn('id', $productIds)
                           ->get()
                           ->keyBy('id'); // index by product ID for easy lookup

        return view('cart', compact('cartItems', 'products'));
    }

    public function removeFromCart($id)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        $cartItem = CartItem::where('id', $id)
                           ->where('user_id', session('user_id'))
                           ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart');
    }

    public function emptyCart()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        CartItem::where('user_id', session('user_id'))->delete();
        return redirect()->route('cart');
    }
}
