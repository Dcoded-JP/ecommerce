<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $size= Size::all();
        return view('Backend.Size.index',compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedSize = $request->validate([
            'size_name'=> 'required|unique:sizes|max:255',
        ]);

        Size::create($validatedSize);
        return Redirect::route('size.index')->with('success', 'Size Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $size = Size::find($id);
        return view('Backend.Size.show',compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return redirect()->route('size.index')
                            ->with('error', 'Size not found');
        }

        return view('Backend.Size.edit', compact('size'));
    }

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    // Find the Size
    $size = Size::findOrFail($id);

    // Validate the request
    $validatedData = $request->validate([
        'size_name' => 'required|max:255|unique:sizes,size_name,'.$id,
    ]);

    // Update the size
    $size->update($validatedData);

    // Redirect with success message
    return redirect()
        ->route('size.index')
        ->with('success', 'Size updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()
        ->route('size.index')
        ->with('success', 'Size deleted successfully');

    }

    public function massDelete(Request $request)
    {
        // Validate the request
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:sizes,id'
        ]);

        try {
            // Delete the selected sizes
            Size::whereIn('id', $request->ids)->delete();




            return response()->json([
                'success' => true,
                'message' => 'Selected Sizes have been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while deleting Sizes.'
            ], 500);
        }
    }
}
