<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category= Category::all();
        return view('Backend.Category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedCategory = $request->validate([
            'category_name'=> 'required|unique:categories|max:255',
        ]);

        Category::create($validatedCategory);
        return Redirect::route('category.index')->with('success', 'Category Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('Backend.Category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.index')
                            ->with('error', 'Category not found');
        }

        return view('Backend.Category.edit', compact('category'));
    }

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    // Find the category
    $category = Category::findOrFail($id);

    // Validate the request
    $validatedData = $request->validate([
        'category_name' => 'required|max:255|unique:categories,category_name,'.$id,
    ]);

    // Update the category
    $category->update($validatedData);

    // Redirect with success message
    return redirect()
        ->route('category.index')
        ->with('success', 'Category updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()
        ->route('category.index')
        ->with('success', 'Category deleted successfully');

    }

    public function massDelete(Request $request)
    {
        // Validate the request
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:categories,id'
        ]);

        try {
            // Delete the selected categories
            Category::whereIn('id', $request->ids)->delete();




            return response()->json([
                'success' => true,
                'message' => 'Selected categories have been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while deleting categories.'
            ], 500);
        }
    }
}
