<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index() {
        
        if (Auth::check()){
            if (Auth::user()->usertype == 0) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('user');
            }
        }
        
        $categories = Category::take(4)->get(); 
        $recipes = Recipe::take(8)->get(); 
        return view('homepage', compact('categories', 'recipes'));
    }
    

    public function user (){
        $categories = Category::take(4)->get(); 
        $recipes = Recipe::take(8)->get(); 
        return view('layouts.app',compact('categories', 'recipes'));
    }

    public function category($id){
        $category = Category::findOrFail($id);
        $recipes = $category->recipes()->paginate(10); 
        return view('layouts.category', compact('category', 'recipes'));
    }

    public function recipe($id){
        $recipe = Recipe::findOrFail($id);
        $categories=Category::all();
        $recipe_categories = $recipe->categories; 
        return view('layouts.recipe',compact('recipe','recipe_categories','categories'));
    }
}
