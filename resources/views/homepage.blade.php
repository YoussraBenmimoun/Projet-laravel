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

    <header>
        <div class="container mx-auto">
            <nav class="sm:hidden pt-3 pb-2">
                <ul class="flex justify-center gap-10">
                    <li class="hover:text-gray-500"><a href="#about">A propos</a></li>
                    <li class="hover:text-gray-500"><a href="#services">Catégories</a></li>
                    <li class="hover:text-gray-500"><a href="#portfolio">Recettes</a></li>
                    <li class="hover:text-gray-500"><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <nav class="justify-between items-center h-10 p-10 hidden sm:flex">
                
 
                <img class="h-5" src="{{asset('storage/images/assiette.png') }}" alt="">
                
                <ul class="flex gap-10">
                    <li class="hover:text-gray-500"><a href="#about">A propos</a></li>
                    <li class="hover:text-gray-500"><a href="#services">Catégories</a></li>
                    <li class="hover:text-gray-500"><a href="#portfolio">Recettes</a></li>
                    <li class="hover:text-gray-500"><a href="#contact">Contact</a></li>
                </ul>

                <a class="px-5 py-1 bg-gray-50 rounded-full ring-1 ring-gray-100 hover:bg-white"
                    href="{{route('loginForm')}}">Log In</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="p-20">
            <div class="container mx-auto">
                <div class="flex justify-center">
                    <div class="flex flex-col gap-5 text-center">
                        <img class="rounded-full bg-gray-50 h-52 w-86 mx-auto" src="{{asset('storage/images/assiette.png') }}" />
                        <div class="flex flex-col gap-3">
                            <p class="text-gray-500 text-2xl">Recettes faciles et rapides pour vous inspirer en cuisine.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="sm:p-10 lg:p-20 bg-gray-50">
            <div class="container mx-auto">
                <div class="sm:columns-2">
                    <img class="sm:w-1/2 mb-10 sm:mb-5" src="{{asset('storage/images/blogueuse.png') }}" />
                    <div>
                        <h2 class="text-bold text-2xl mb-3">Camille Lefèvre</h2>
                        <p class="mb-5 text-sm text-gray-400">Camille Lefèvre</p>
                        <p class="text-gray-500 text-justify leading-10">
                            Blogueuse dans la vraie vie et passionnée de cuisine, j'ai souhaité créer ce blog afin d'allier ces deux aspects de mon quotidien ! Je suis en quête de recettes saines et gourmandes qui pourront ravir vos papilles. Les recettes sont confectionnées avec des produits frais et conviennent à tout le monde : même aux personnes intolérantes (gluten-free, lactose-free) !
                        </p>
                    </div>
                </div>
            </div>
        </section>

       
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

        
        <section class="sm:p-20 p-5" id="contact">
            <div class="sm:container mx-auto">
                <h2 class="text-center text-4xl font-bold pb-10">Sign In</h2>
                <div class="sm:flex justify-center items-center">
                    <div class="sm:w-1/2 mb-10 sm:mb-5 text-center">
                        <img class="sm:w-3/4 mx-auto" src="{{asset('storage/images/recette-eclair-facon-poire-belle-helene-anne-sophie-pic1.png') }}" />
                    </div>
        
                    <div class="sm:w-1/2 w-full bg-gray-50 p-10 rounded-md">
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-y-5">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
                                <input autocomplete="name" type="text" id="name" name="name" value="{{ old('name')}}"  
                                class="block w-full outline-1 border border-gray-300 rounded py-2 px-4 bg-transparent text-gray-900 placeholder-gray-400 text-sm leading-6" placeholder="Saisissez votre nom">
                                @error('name')
                                    {{$message}}
                                @enderror
        
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <input autocomplete="email" type="email" id="email" name="email" value="{{ old('email')}}" 
                                class="block w-full outline-1 border border-gray-300 rounded py-2 px-4 bg-transparent text-gray-900 placeholder-gray-400 text-sm leading-6" placeholder="Saisissez votre email">
                                @error('email')
                                    {{$message}}
                                @enderror
        
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                                <input type="password" id="password" name="password" value="{{ old('password')}}" 
                                class="block w-full outline-1 border border-gray-300 rounded py-2 px-4 bg-transparent text-gray-900 placeholder-gray-400 text-sm leading-6" placeholder="Saisissez votre mot de passe">
                                @error('password')
                                    {{$message}}
                                @enderror

                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirmez le mot de passe</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation')}}" 
                                class="block w-full outline-1 border border-gray-300 rounded py-2 px-4 bg-transparent text-gray-900 placeholder-gray-400 text-sm leading-6" placeholder="Confirmez votre mot de passe">
                                @error('password_confirmation')
                                    {{$message}}
                                @enderror

                            </div>
        
                            <div class="mt-5">
                                <button class="w-full bg-gray-200 text-gray-700 hover:bg-white border border-gray-300 rounded-md py-2 px-4">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        

    </main>

    
    <footer class="bg-gray-50 lg:p-20 p-10">
        <section class="container mx-auto">
            <div class="sm:flex justify-center sm:justify-between sm:flex-wrap lg:justify-between">
                <h6 class="text-center font-bold text-2xl mb-10 sm:mb-0">Quick links</h6>
    
                <div class="flex justify-center sm:justify-start">
                    <ul class="flex">
                        <li class="m-3 hover:text-gray-500"><a href="#about">A propos</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="#services">Catégories</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="#portfolio">Recettes</a></li>
                        <li class="m-3 hover:text-gray-500"><a href="#contact">Sign In</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </footer>
    
    
</body>
</html>