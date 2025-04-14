<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color= Color::all();
        return view('Backend.Color.index',compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedColor = $request->validate([
            'color_name'=> 'required|unique:colors|max:255',
        ]);

        Color::create($validatedColor);
        return Redirect::route('color.index')->with('success', 'Color Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $color = Color::find($id);
        return view('Backend.Color.show',compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $color = Color::find($id);

        if (!$color) {
            return redirect()->route('color.index')
                            ->with('error', 'color not found');
        }

        return view('Backend.color.edit', compact('color'));
    }

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    // Find the color
    $color = color::findOrFail($id);

    // Validate the request
    $validatedData = $request->validate([
        'color_name' => 'required|max:255|unique:colors,color_name,'.$id,
    ]);

    // Update the color
    $color->update($validatedData);

    // Redirect with success message
    return redirect()
        ->route('color.index')
        ->with('success', 'color updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $color = color::findOrFail($id);
        $color->delete();

        return redirect()
        ->route('color.index')
        ->with('success', 'color deleted successfully');

    }

    public function massDelete(Request $request)
    {
        // Validate the request
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:colors,id'
        ]);

        try {
            // Delete the selected color
            color::whereIn('id', $request->ids)->delete();




            return response()->json([
                'success' => true,
                'message' => 'Selected color have been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while deleting color.'
            ], 500);
        }
    }
}
