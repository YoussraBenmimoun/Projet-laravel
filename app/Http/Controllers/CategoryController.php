<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images');

        $category = new Category();
        $category->nom = $validatedData['nom'];
        $category->image = $imagePath;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category->nom = $validatedData['nom'];

        if ($request->hasFile('image')) {

            if ($category->image) {
                $path = public_path('storage/' . $category->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $category->image = $request->image->store('images');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }

    /**
     * Search for categories.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::where('nom', 'like', "%$query%")->paginate(5);

        return view('categories.index', compact('categories'));
    }
}
