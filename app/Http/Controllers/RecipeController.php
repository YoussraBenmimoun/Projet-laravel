<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Imports\RecipesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes=Recipe::latest()->paginate(5);
        $categories=Category::all();
        return view('recipes.index',compact('recipes','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('recipes.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $imagePath = $request->file('image')->store('images');
        $recipe = new Recipe([
            'titre' => $request->titre,
            'description' => $request->description,
            'image' => $imagePath,
            'date_de_publication' => $request->date_de_publication,
            'temps_de_preparation' => $request->temps_de_preparation,
            'temps_de_cuisson' => $request->temps_de_cuisson,
            'niveau_de_difficulte' => $request->niveau_de_difficulte,
        ]);

        $recipe->save();
        $categories = $request->input('categories');
        $recipe->categories()->attach($categories);

        $ingredients = explode("\n", $request->ingredients);
        foreach ($ingredients as $ingredient) {
            $ingredientData = explode(':', $ingredient);
            $nom = $ingredientData[0];
            $quantite = $ingredientData[1] ?? null;

            $existingIngredient = Ingredient::where('nom', $nom)->first();

            if (!$existingIngredient) {
                $newIngredient = Ingredient::create(['nom' => $nom]);
                $ingredientId = $newIngredient->id;
            } else {
                $ingredientId = $existingIngredient->id;
            }

            $recipe->ingredients()->attach($ingredientId, ['quantite' => $quantite]);
        }

        return redirect()->route('recipes.index')->with('success', 'Recette créée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $categories=Category::all();
        $recipe_categories = $recipe->categories; 
        return view('recipes.show',compact('recipe','recipe_categories','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories=Category::all();
        $recipe_categories = $recipe->categories; 
        return view('recipes.edit', compact('recipe','recipe_categories','categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRecipeRequest $request, Recipe $recipe)
    {
        if ($request->hasFile('image')) {
         
            if($recipe->image) 
            { 
                $path = public_path('storage/'.$recipe->image);
                if (file_exists($path)) {
                  unlink($path); 
                   }
           }
         $recipe->image=$request->image->store('images');
            
       }

        $recipe->titre = $request->titre;
        $recipe->description = $request->description;
        $recipe->date_de_publication = $request->date_de_publication;
        $recipe->temps_de_preparation = $request->temps_de_preparation;
        $recipe->temps_de_cuisson = $request->temps_de_cuisson;
        $recipe->niveau_de_difficulte = $request->niveau_de_difficulte;

        
        $recipe->save();

      
        $categories = $request->input('categories');
        $recipe->categories()->sync($categories);

        
        $ingredients = explode("\n", $request->ingredients);
        $recipe->ingredients()->detach(); 
        foreach ($ingredients as $ingredient) {
            $ingredientData = explode(':', $ingredient);
            $nom = $ingredientData[0];
            $quantite = $ingredientData[1] ?? null;

            $existingIngredient = Ingredient::where('nom', $nom)->first();

            if (!$existingIngredient) {
                $newIngredient = Ingredient::create(['nom' => $nom]);
                $ingredientId = $newIngredient->id;
            } else {
                $ingredientId = $existingIngredient->id;
            }

            if ($quantite !== null) { 
                $recipe->ingredients()->attach($ingredientId, ['quantite' => $quantite]);
            } 
        }

        return redirect()->route('recipes.index')->with('success', 'Recette mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->categories()->detach();
        $recipe->ingredients()->detach();
        // Storage::delete($recipe->image);

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recette supprimée avec succès.');
    }


    public function showImportForm()
    {
        return view('recipes.import');
    }


    public function import(Request $request) 
    {
    
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', 
        ]);

        $file = $request->file('file');

        Excel::import(new RecipesImport, $file);

        return redirect()->route('recipes.index')->with('succès', 'Fichier importé!');
    }

    public function search(Request $request)
        {
            $query = $request->input('query');
            
            $recipes = Recipe::where('titre', 'like', "%$query%")
                            ->orWhere('description', 'like', "%$query%")
                            ->orWhereHas('categories', function ($query) use ($request) {
                                $query->where('nom', 'like', "%".$request->input('query')."%");
                            });

            $recipes = $recipes->paginate(10);
                            
            return view('recipes.index', compact('recipes'));
        }
}
