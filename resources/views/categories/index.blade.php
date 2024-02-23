@extends('admin.layout')

@section('content')
@auth
<div class="antialiased font-sans bg-gray-200">
    <div class="container mx-auto px-4 sm:px-8">
        
                    <div class="py-8">
                        <h2 class="text-3xl font-bold mb-4">Catégories</h2>
                        <div class="flex items-center justify-between mb-4">
                            <a href="{{ route('categories.create') }}" 
                            class="bg-white-300 hover:bg-gray-500 text-gray-800 font-semibold py-2 px-4 rounded inline-block transition-colors duration-300 ease-in-out">
                            Ajouter une catégorie -></a>
                        </div>
                        
                    
                
                
                <div class="block relative">
                    
                    
                        <form action="{{ route('categories.search') }}" method="GET" class="mb-4">
                            
                            <div class="flex items-center mb-5">
                                <input type="text" name="query" class="appearance-none rounded-l border border-gray-400 border-b block pl-8 pr-6 py-2 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none w-full" placeholder="Rechercher...">
                                <button type="submit" class="bg-blue-200 hover:bg-blue-400 text-blue-800 font-semibold py-2 px-4 rounded-l-none inline-block transition-colors duration-300 ease-in-out">Rechercher</button>
                            </div>
                            
                        </form>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Image
                                </th>
                                
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            {{$category->id}}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$category->nom}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <img src="{{asset('storage/'.$category->image)}}" alt="" width="100" height="100">
                                </td>
                                
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <a href="{{ route('categories.edit', $category->id) }}" 
                                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-300 rounded shadow">Modifier</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-300 rounded shadow"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div> 
@else
<div>Connexion requise</div>
@endauth
@endsection