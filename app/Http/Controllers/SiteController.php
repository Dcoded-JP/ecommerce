<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class SiteController extends Controller
{
    public function index()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('signup');
        }
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
        $products = Product::all();
        // Get unique categories for the filter
        $categories = Product::select('category')->distinct()->get();
        
        return view('product', compact('products', 'categories'));
    }

    public function productDetails($id)
    {
        $product = Product::find($id);

        $products = Product::all();
        // Get unique categories for the filter
        $categories = Product::select('category')->distinct()->get();
        return view('product_details', compact('product', 'products', 'categories'));
    }
}
