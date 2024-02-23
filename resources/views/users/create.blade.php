@extends('admin.layout')
@section('content')
@auth
<div class="bg-gray-200 py-32 px-10 min-h-screen ">
  <div class="bg-white p-10 md:w-3/4 lg:w-1/2 mx-auto">

      <h1 class="text-3xl text-center font-bold text-gray-600 mb-5">Créer un utilisateur</h1>

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">

      @csrf

      <div class="flex items-center mb-5">
        <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Nom</label>
        <input placeholder="Nom" type="text" name="name" id="name" value="{{ old('name') }}"
               class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                      text-gray-600 placeholder-gray-400
                      outline-none">
          @error('name')
              {{ $message }}
          @enderror
      </div>

      <div class="flex items-center mb-5">
          <label for="email" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Email</label>
          <input placeholder="Email" type="text" name="email" id="email" value="{{ old('email') }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('email')
                {{ $message }}
            @enderror
      </div>

      

        <div class="flex items-center mb-5">
          <label for="password" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Mot de passe</label>
          <input placeholder="Mot de passe" type="password" name="password" id="password" value="{{ old('password') }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('password')
                {{ $message }}
            @enderror
        </div>

        <div class="flex items-center mb-5">
          <label for="usertype" class="inline-block w-20 mr-6 text-right font-bold text-gray-600">Type</label>
          <input placeholder="0 pour l'Admin et 1 pour un user normal" type="text" name="usertype" id="usertype" value="{{ old('usertype') }}"
                 class="flex-1 py-2 border-b-2 border-gray-400 focus:border-green-400 
                        text-gray-600 placeholder-gray-400
                        outline-none">
            @error('usertype')
                {{ $message }}
            @enderror
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