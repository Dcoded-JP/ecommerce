<?php

namespace App\Http\Controllers;

use App\Models\IProduct;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;

use Illuminate\Http\Request;


class IProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('Backend.IProduct.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=Category::select('id','category_name')->get();
        $color=Color::select('id','color_name')->get();
        $size= Size::select('id','size_name')->get();

        return view('Backend.IProduct.create',compact('category','color','size'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $iProduct = IProduct::create($request->all());
        return redirect()->route('iproducts.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IProduct $iProduct)
    {
        return view('iproducts.show', compact('iProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IProduct $iProduct)
    {
        return view('iproducts.edit', compact('iProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IProduct $iProduct)
    {
        $iProduct->update($request->all());
        return redirect()->route('iproducts.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IProduct $iProduct)
    {
        $iProduct->delete();
        return redirect()->route('iproducts.index')->with('success', 'Product deleted successfully.');
    }
}
