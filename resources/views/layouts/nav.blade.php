<header>
    <div class="container mx-auto">
        <nav class="sm:hidden pt-3 pb-2">
            <ul class="flex justify-center gap-10">
                <li class="hover:text-gray-500"><a href="#about">A propos</a></li>
                <li class="hover:text-gray-500"><a href="#services">Catégories</a></li>
                <li class="hover:text-gray-500"><a href="#portfolio">Recettes</a></li>
                <li class="hover:text-gray-500"><a href="#contact"></a></li>
            </ul>
        </nav>
        <nav class="justify-between items-center h-10 p-10 hidden sm:flex">
            

            <a href="{{ route('user') }}">
                <img class="h-5" src="{{asset('storage/images/assiette.png') }}" alt="">
            </a>
            
            <ul class="flex gap-10">
                <li class="hover:text-gray-500"><a href="{{ route('user') }}#about">A propos</a></li>
                <li class="hover:text-gray-500"><a href="{{ route('user') }}#services">Catégories</a></li>
                <li class="hover:text-gray-500"><a href="{{ route('user') }}#portfolio">Recettes</a></li>
                <li class="hover:text-gray-500"><a href="{{ route('user') }}#contact"></a></li>
            </ul>

            <a class="px-5 py-1 bg-gray-50 rounded-full ring-1 ring-gray-100 hover:bg-white"
            href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>
</header>