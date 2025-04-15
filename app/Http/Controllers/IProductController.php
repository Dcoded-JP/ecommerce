<?php

namespace App\Http\Controllers;

use App\Models\IProduct;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class IProductController extends Controller
{
    private const IPRODUCT_RULES = [
        'product_name' => 'required|string|max:255',
        'sub_title' => 'nullable|string|max:255',
        'sku' => 'required|string|unique:i_products,sku',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'color_id' => 'required|exists:colors,id',
        'size_id' => 'required|exists:sizes,id',
    ];
    private const IMG_RULES = [
        'product_img.*' => 'required|image|mimes:jpeg,png,jpg|max:5120|dimensions:max_width=4920,max_height=4080',
    ];

    public function index()
    {
        $iproduct = IProduct::with(['category', 'color', 'size'])->get();
        return view('Backend.IProduct.index', compact('iproduct'));
    }

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
        //validate data
        $v_iproduct=$request->validate(self::IPRODUCT_RULES);

        if($request->has('product_img')){
            $request->validate(self::IMG_RULES);
        }
        //store
        DB::beginTransaction();
        try {
            //store iproduct
            $ipro=IProduct::create($v_iproduct);
            //store img
            if($request->has('product_img') && $request->input('have_img')=="1"){
                $this->saveProductImg($ipro,$request);
            }

            DB::commit();

            return redirect()->route('iproduct.index')
                ->with('success', 'I Product created successfully.');
        }catch (\Exception $e) {
            DB::rollBack();
            return  dd($e->getMessage());
            Log::error('iproduct store error: ' . $e->getMessage());

            // Clean up uploaded file if error occurs
            // if (isset($v_EmpPersonal['user_img_path'])) {
            //     Storage::disk('public')->delete($v_EmpPersonal['user_img_path']);
            // }

            return back()
                ->withInput()
                ->with('error', 'Error creating employee. Please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $iProduct=IProduct::find($id);
        $iProduct->load(['category', 'color', 'size', 'productImages']);
        return view('Backend.IProduct.show', compact('iProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $iProduct=IProduct::find($id);
        $category = Category::select('id', 'category_name')->get();
        $color = Color::select('id', 'color_name')->get();
        $size = Size::select('id', 'size_name')->get();
        $iProduct->load(['category', 'color', 'size', 'productImages']);

        return view('Backend.IProduct.edit', compact('iProduct', 'category', 'color', 'size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $iProduct=IProduct::find($id);
        // Modify validation rules for update to ignore unique SKU for current product
        $updateRules = array_merge(self::IPRODUCT_RULES, [
            'sku' => 'required|string|unique:i_products,sku,' . $iProduct->id,
        ]);

        // Validate basic product data
        $validatedData = $request->validate($updateRules);

        DB::beginTransaction();
        try {
            // Update basic product information
            $iProduct->update($validatedData);

            // Handle image updates if new images are provided
            if ($request->has('product_img') && $request->input('have_img') == "1") {
                $request->validate(self::IMG_RULES);
                $this->saveProductImg($iProduct, $request);
            }

            // Handle image deletions if any
            if ($request->has('delete_images')) {
                foreach ($request->input('delete_images') as $imageId) {
                    $image = $iProduct->productImages()->find($imageId);
                    if ($image) {
                        // Delete the physical file
                        Storage::disk('public')->delete('iproduct_img/' . $image->product_img);
                        // Delete the record
                        $image->delete();
                    }
                }
            }

            DB::commit();
            return redirect()->route('iproduct.index')
                ->with('success', 'Product updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error updating product. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $iProduct=IProduct::find($id);
        DB::beginTransaction();
        try {
            // Delete associated images from storage
            foreach ($iProduct->productImages as $image) {
                Storage::disk('public')->delete('iproduct_img/' . $image->product_img);
            }

            // Delete the product (will cascade delete related records)
            $iProduct->delete();

            DB::commit();
            return redirect()->route('iproduct.index')
                ->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());
            return back()->with('error', 'Error deleting product. Please try again.');
        }
    }

    public function saveProductImg(IProduct $ipro, Request $request)
    {
        try {
            // Handle multiple file uploads
            if ($request->hasFile('product_img')) {
                foreach ($request->file('product_img') as $index => $file) {
                    // Validate the file
                    if ($file && $file->isValid()) {
                        // Generate unique filename
                        $filename = time() . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                        // Store the file
                        $filePath = $file->storeAs('iproduct_img', $filename, 'public');

                        // Create the Product_image record
                        $ipro->productImages()->create([
                            'product_img' => $filename,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error saving product images: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Mass delete products.
     */
    public function massDelete(Request $request)
    {
        // Validate the request
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:i_products,id'
        ]);

        DB::beginTransaction();
        try {
            // Get all products with their images
            $products = IProduct::whereIn('id', $request->ids)->with('productImages')->get();

            foreach ($products as $product) {
                // Delete associated images from storage
                foreach ($product->productImages as $image) {
                    Storage::disk('public')->delete('iproduct_img/' . $image->product_img);
                }
            }

            // Delete the products (will cascade delete related records)
            IProduct::whereIn('id', $request->ids)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' products have been deleted successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in mass delete: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting products: ' . $e->getMessage()
            ], 500);
        }
    }
}
