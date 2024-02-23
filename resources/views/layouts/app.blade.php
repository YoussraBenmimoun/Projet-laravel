<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>De la recette à l'assiette</title>
</head>
<body class="h-screen">

    
    @auth
    @include('layouts/nav') 

    <main>
        @include('layouts/header')

        @include('layouts/about')

        <section id="services" class="sm:p-10 lg:p-20 p-5">
            <div class="sm:container mx-auto">
                <h2 class="text-center text-4xl font-bold pt-10 sm:pt-0 pb-10">Catégories</h2>
                <div class="sm:grid grid-cols-2 gap-8">
                    @if ($categories->isEmpty())
                        <div class="text-center text-gray-500">Pas de catégories disponibles.</div>
                    @else
                        @foreach ($categories as $category)
                            <a href="{{route('category-recipes',$category->id)}}">
                                <div class="sm:p-10 p-5 bg-gray-0 rounded-md hover:shadow-md flex flex-col justify-center items-center">
                                    <h3 class="text-3xl text-center mb-5 font-bold">{{$category->nom}}</h3>
                                    <div class="w-full">
                                        <img class="w-full h-auto" src="{{asset('storage/'.$category->image)}}" alt="{{$category->nom}}" />
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <section class="lg:p-20 p-5" id="portfolio">
            <div class="lg:container mx-auto">
                <h2 class="text-center text-4xl font-bold pb-10">Recettes</h2>
                <div class="lg:columns-4 sm:columns-2">
                    @if ($recipes->isEmpty())
                        <div></div>
                    @else
                        @foreach ($recipes as $recipe)
                            <a href="{{route('recipe-details',$recipe->id)}}">
                                <div class="p-5 bg-gray-50 sm:me-5 sm:mb-10 mb-5 rounded-md hover:shadow-md">
                                    <h3 class="text-xl mb-5">{{$recipe->titre}}</h3>
                                    <img class="rounded-md h-48 max-h-48 w-full" src="{{asset('storage/'.$recipe->image)}}" />
                                </div>
                            </a>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
    </main>

    @include('layouts/footer')
    
    @else
        <div>Connexion Requise</div>
    @endauth
    
    
</body>
</html>