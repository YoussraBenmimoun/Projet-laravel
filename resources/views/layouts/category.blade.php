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
 
 <main class="py-10">
     <div class="container mx-auto">
         <h1 class="text-3xl font-bold mb-8">Recettes de la catégorie {{ $category->nom }}</h1>
 
         <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
             @if ($recipes->isEmpty())
                 <div class="text-center text-gray-500">Aucune recette disponible dans cette catégorie.</div>
             @else
                 @foreach ($recipes as $recipe)
                     <a href="{{route('recipe-details',$recipe->id)}}">
                        <div class="p-5 bg-gray-100 rounded-md hover:shadow-md">
                            <h3 class="text-lg font-semibold mb-2">{{ $recipe->titre }}</h3>
                            <img class="w-full h-auto rounded-md" src="{{ asset('storage/'.$recipe->image) }}" alt="{{ $recipe->titre }}" />
                        </div>
                     </a>
                 @endforeach
             @endif
         </section>
 
         {{ $recipes->links() }}
     </div>
 </main>
 
 @include('layouts/footer')
 
 @else
 <header>
    <div class="container mx-auto">
        <nav class="sm:hidden pt-3 pb-2">
            <ul class="flex justify-center gap-10">
                <li class="hover:text-gray-500"><a href="{{ route('home') }}#about">A propos</a></li>
                <li class="hover:text-gray-500"><a href="#services">Catégories</a></li>
                <li class="hover:text-gray-500"><a href="#portfolio">Recettes</a></li>
                <li class="hover:text-gray-500"><a href="#contact">Contact</a></li>
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
 <div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-8">Recettes de la catégorie {{ $category->nom }}</h1>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @if ($recipes->isEmpty())
            <div class="text-center text-gray-500">Aucune recette disponible dans cette catégorie.</div>
        @else
            @foreach ($recipes as $recipe)
                <div class="p-5 bg-gray-100 rounded-md hover:shadow-md">
                    <h3 class="text-lg font-semibold mb-2">{{ $recipe->titre }}</h3>
                    <img class="w-full h-auto rounded-md" src="{{ asset('storage/'.$recipe->image) }}" alt="{{ $recipe->titre }}" />
                </div>
            @endforeach
        @endif
    </section>

    {{ $recipes->links() }}
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
 @endauth
 
 </body>
 </html>
 