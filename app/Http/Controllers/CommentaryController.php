<?php

namespace App\Http\Controllers;

use App\Models\Commentary;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recipe = Recipe::findOrFail($request->id_recipe);
        $recipe->commentaries()->create([
            'contenu' => $request->contenu,
            'user_id' => auth()->id()]);

        return redirect()->back()->with('success', 'Commentaire ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentary $commentary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentary $commentary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentary $commentary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentary $commentary)
    {
        //
    }
}
