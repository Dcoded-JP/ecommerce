<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function index()
    {
        $productimage = ProductImage::all();
        return view('Backend.ProductImage.index', compact('productimage'));
    }

    public function create()
    {
        return view('Backend.ProductImage.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'iproduct_id' => 'required|numeric',
            'product_img' => 'required|image|mimes:jpeg,png,jpg|max:5120|dimensions:max_width=2920,max_height=2080'
        ]);
        try {
            // Handle file upload
            if ($request->hasFile('product_img')) {
                $image = $request->file('product_img');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('p_image', $filename, 'public');

                // Create product image record
                ProductImage::create([
                    'iproduct_id' => $request->input('iproduct_id'),
                    'product_img' => $path,

                ]);

                return redirect()->route('productimage.index')
                    ->with('success', 'Product image uploaded successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error uploading image: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $productimage=ProductImage::find($id);
        return view('Backend.ProductImage.show', compact('productimage'));
    }

    public function edit($id)
    {
        $productimage=ProductImage::find($id);
        return view('Backend.ProductImage.edit', compact('productimage'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'iproduct_id' => 'required|numeric',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120|dimensions:max_width=2920,max_height=2080'
        ]);

        $productImage=ProductImage::find($id);

        try {
            if ($request->hasFile('product_img')) {
                // Delete old image
                if (Storage::disk('public')->exists('product_images/' . $productImage->product_img)) {
                    Storage::disk('public')->delete('product_images/' . $productImage->product_img);
                }

                // Upload new image
                $image = $request->file('product_img');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('product_images', $filename, 'public');

                // Update product image record
                $productImage->update([
                    'iproduct_id' => $request->input('iproduct_id'),
                    'product_img' => $filename
                ]);

                return redirect()->route('productimage.index')
                    ->with('success', 'Product image updated successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating image: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {

        $productImage=ProductImage::find($id);
        try {
            // Delete image file
            if (Storage::disk('public')->exists('product_images/' . $productImage->product_img)) {
                Storage::disk('public')->delete('product_images/' . $productImage->product_img);
            }

            // Delete record
            $productImage->delete();

            return redirect()->route('productimage.index')
                ->with('success', 'Product image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:product_images,id'
        ]);

        try {
            $images = ProductImage::whereIn('id', $request->ids)->get();

            foreach ($images as $image) {
                // Delete image file
                if (Storage::disk('public')->exists('product_images/' . $image->product_img)) {
                    Storage::disk('public')->delete('product_images/' . $image->product_img);
                }
            }

            // Delete records
            ProductImage::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Selected images have been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting images: ' . $e->getMessage()
            ], 500);
        }
    }
}
