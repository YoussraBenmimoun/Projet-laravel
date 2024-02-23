@extends('admin.layout')
@section('content')
@auth
<div class="container mx-auto mt-8">
    <div class="flex justify-center">
        <div class="w-full max-w-3xl">
            <div class="bg-white shadow-md rounded px-8 py-6">
                <h1 class="text-2xl font-bold mb-4">Import des recettes</h1>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('recipes.import') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Sélectionnez un fichier Excel</label>
                        <input type="file" id="file" name="file" accept=".xlsx, .xls, .csv" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Importer un fichier</button>
                </form>
            </div>
        </div>
    </div>
</div>  
@else
<div>Connexion requise</div>
@endauth
@endsection