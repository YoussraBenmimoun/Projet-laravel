<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    
    @auth
    @include('layouts/nav') 
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
                            <span>{{ $recipe->temps_de_preparation }} </span>
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
        <div id="commentaires" class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Commentaires</h2>
        
            @if ($recipe->commentaries->isEmpty())
                
            @else
                @foreach ($recipe->commentaries as $commentary)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <strong class="text-gray-700">
                            {{ $commentary->user->name }} 
                        </strong>
                        <p><small> {{$commentary->created_at->format('d/m/Y')}} </small></p>
                        <i class="text-gray-700">{{ $commentary->contenu }}</i>
                        <hr>
                    </div>
                @endforeach
            @endif
            
        
            <a href="#" id="show-comment-form" class="text-blue-500 hover:underline">Ajouter un commentaire</a>
        
            <form action="{{ route('commentaries.store',$recipe->id) }}" method="post" id="comment-form" class="mt-4 hidden">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id_recipe" value="{{ $recipe->id }}">
                    <label for="contenu" class="block font-semibold">Contenu du commentaire</label>
                    <textarea name="contenu" id="contenu" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" rows="3"></textarea>
                    @error('contenu')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="mt-2 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Ajouter un commentaire</button>
            </form>
        </div>
        
    </div>
    @include('layouts/footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            var showCommentFormLink = document.getElementById('show-comment-form');
            var commentForm = document.getElementById('comment-form');
    
            
            showCommentFormLink.addEventListener('click', function(event) {
                event.preventDefault();
                commentForm.style.display = 'block';
            });
        });
    </script>
    @else
    <header>
        <div class="container mx-auto">
            <nav class="sm:hidden pt-3 pb-2">
                <ul class="flex justify-center gap-10">
                    <li class="hover:text-gray-500"><a href="{{ route('home') }}#about">A propos</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('user') }}#services">Catégories</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('user') }}#portfolio">Recettes</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('user') }}#contact">Contact</a></li>
                </ul>
            </nav>
            <nav class="justify-between items-center h-10 p-10 hidden sm:flex">
                
 
                <a href="{{ route('home') }}">
                    <img class="h-5" src="{{asset('storage/images/assiette.png') }}" alt="">
                </a>
                
                <ul class="flex gap-10">
                    <li class="hover:text-gray-500"><a href="{{ route('home') }}#about">A propos</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('home') }}#services">Catégories</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('home') }}#portfolio">Recettes</a></li>
                    <li class="hover:text-gray-500"><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>

                <a class="px-5 py-1 bg-gray-50 rounded-full ring-1 ring-gray-100 hover:bg-white"
                    href="{{route('loginForm')}}">Log In</a>
            </nav>
        </div>
    </header>
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
                            <span>{{ $recipe->temps_de_preparation }} </span>
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
        <div id="commentaires" class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Commentaires</h2>
        
            @if ($recipe->commentaries->isEmpty())
                
            @else
                @foreach ($recipe->commentaries as $commentary)
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <p class="text-gray-700">
                            {{ $commentary->user->name }} 
                            <span> {{$commentary->created_at->format('d/m/Y')}} </span></p>
                        <p class="text-gray-700">{{ $commentary->contenu }}</p>
                    </div>
                @endforeach
            @endif
            
        
            <a href="#" id="show-comment-form" class="text-blue-500 hover:underline">Ajouter un commentaire</a>
            <div id="comment-message" style="display:none; color:red">Vous devez vous connecter pour ajouter un commentaire *</div>
        </div>
        
    </div>
    <footer class="bg-gray-50 lg:p-20 p-10">
        <section class="container mx-auto">
            <div class="sm:flex justify-center sm:justify-between sm:flex-wrap lg:justify-between">
                <h6 class="text-center font-bold text-2xl mb-10 sm:mb-0">Quick links</h6>
    
                <div class="flex justify-center sm:justify-start">
                    <ul class="flex">
                        <li class="m-3 hover:text-gray-500"><a href="{{ route('home') }}#about">A propos</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="{{ route('home') }}#services">Catégories</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="{{ route('home') }}#portfolio">Recettes</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="{{ route('home') }}#contact">Sign In</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var showCommentFormLink = document.getElementById('show-comment-form');
            var commentMessage = document.getElementById('comment-message');
    
            showCommentFormLink.addEventListener('click', function(event) {
                event.preventDefault();
                commentMessage.style.display = 'block';
            });
        });
    </script>
    
    @endauth


</body>
</html>