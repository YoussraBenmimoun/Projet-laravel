@extends('admin.layout')

@section('content')
@auth
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4">
                <h1 class="text-3xl font-semibold mb-2">{{ $recipe->titre }}</h1>
                <p class="text-gray-600 mb-4">{{ $recipe->description }}</p>
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->titre }}" class="w-full h-auto rounded-lg">
                </div>
                <div class="py-2 border-t border-gray-200">
                    <div class="mb-2">
                        <span class="font-semibold">Temps de préparation:</span>
                        <span>{{ $recipe->temps_de_preparation }} minutes</span>
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Temps de cuisson:</span>
                        <span>{{ $recipe->temps_de_cuisson }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Niveau de difficulté:</span>
                        <span>{{ $recipe->niveau_de_difficulte }}</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Ingrédients</h2>
                    <ul class="list-disc list-inside">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li>{{ $ingredient->nom }}: {{ $ingredient->pivot->quantite }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Catégories</h2>
                    <ul class="flex flex-wrap">
                        @foreach ($recipe_categories as $category)
                            <li class="mr-2 mb-2 bg-gray-200 rounded-full px-3 py-1 text-sm">{{ $category->nom }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4">
                    <span class="font-semibold">Date de publication:</span>
                    <span>{{ $recipe->date_de_publication }}</span>
                </div>
            </div>
        </div>
    </div>
</div>    
@else
<div>Connexion requise</div>
@endauth
@endsection
