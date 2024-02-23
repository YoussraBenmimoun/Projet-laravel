@extends('admin.layout')
@section('content')
@auth
<div class="bg-gray-200 py-32 px-10 min-h-screen ">
  <div class="bg-white p-10 md:w-3/4 lg:w-1/2 mx-auto">

      <h1 class="text-3xl text-center font-bold text-gray-600 mb-5">Créer une catégorie</h1>

    <form action="{{ route('categories.update',$category) }}" method="post" enctype="multipart/form-data">

      @csrf
      @method('put')

      <div class="flex items-center mb-5">
          <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Nom</label>
          <input placeholder="Nom" type="text" name="nom" id="name" value="{{ old('nom', $category->nom) }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
          @error('nom')
              {{ $message }}
          @enderror
      </div>

      <div class="flex items-center mb-5">
          <label for="image" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Image</label>
          <input type="file" id="image" name="image" placeholder="Image" 
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
          
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