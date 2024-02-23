@extends('admin.layout')
@section('content')
@auth
<div class="bg-gray-200 py-32 px-10 min-h-screen ">
  <div class="bg-white p-10 md:w-3/4 lg:w-1/2 mx-auto">

      <h1 class="text-3xl text-center font-bold text-gray-600 mb-5">Modifier une recette</h1>

    <form action="{{ route('recipes.update',$recipe) }}" method="post" enctype="multipart/form-data">

      @csrf
      @method('put')

      <div class="flex items-center mb-5">
        <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Titre</label>
        <input placeholder="Titre" type="text" name="titre" id="titre" value="{{ old('titre', $recipe->titre) }}"
               class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                      text-gray-600 placeholder-gray-400
                      outline-none">
          @error('titre')
              {{ $message }}
          @enderror
      </div>

      <div class="flex items-center mb-5">
          <label for="description" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Description</label>
          <input placeholder="Description" type="text" name="description" id="description" value="{{ old('description', $recipe->description) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('description')
                {{ $message }}
            @enderror
      </div>

      <div class="flex items-center mb-5">
          <label for="image" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Image</label>
          <input type="file" id="image" name="image" placeholder="Image" 
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
          @error('image')
                {{ $message }}
            @enderror
        </div>

        <div class="flex items-center mb-5">
          <label for="temps_de_preparation" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Temps de préparation</label>
          <input placeholder="Temps de préparation" type="text" name="temps_de_preparation" id="temps_de_preparation" value="{{ old('temps_de_preparation', $recipe->temps_de_preparation) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('temps_de_preparation')
                {{ $message }}
            @enderror
        </div>

        <div class="flex items-center mb-5">
          <label for="temps_de_cuisson" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Temps de cuisson</label>
          <input placeholder="Temps de cuisson" type="text" name="temps_de_cuisson" id="temps_de_cuisson" value="{{ old('temps_de_cuisson', $recipe->temps_de_cuisson) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('temps_de_cuisson')
                {{ $message }}
            @enderror
        </div>

        <div class="flex items-center mb-5">
          <label for="niveau_de_difficulte" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Niveau de difficulté</label>
          <input placeholder="Niveau de difficulté" type="text" name="niveau_de_difficulte" id="niveau_de_difficulte" value="{{ old('niveau_de_difficulte', $recipe->niveau_de_difficulte) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
        </div>

        <div class="flex items-center mb-5">
          <label for="categories" class="inline-block w-20 mr-6 text-right 
                                   font-bold text-gray-600">Catégories</label>
          <select name="categories[]" multiple>
              @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @if($recipe_categories->contains($category)) selected @endif>{{ $category->nom }}</option>
              @endforeach
          </select>
                                  
        </div>

        <div class="flex items-center mb-5">
          <label for="ingredients" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Ingredients</label>
          <textarea placeholder=" ingrédient1:quantité
                                  ingrédient2:quantité
          " type="text" name="ingredients" id="ingredients" value="{{ old('ingredients', $recipe->ingredients) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none"></textarea>
        </div>
      

      <div class="text-right">
        <button class="py-3 px-8 bg-green-400 text-white font-bold">Submit</button> 
      </div>

    </form>
  </div>
</div>
@else
<div>Connexion requise</div>
@endauth
@endsection