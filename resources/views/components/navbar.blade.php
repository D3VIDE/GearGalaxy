<!-- Desktop Navbar -->
<nav class="hidden md:block bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/" class="text-2xl font-bold text-indigo-600 tracking-wide flex items-center">
                    <!-- Gear Galaxy Logo Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    GearGalaxy
                </a>
            </div>

            <!-- Main Navigation -->
            <div class="flex items-center justify-center space-x-1">
                <a href="/" class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium">Home</a>
                <a href="{{ route('shop') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 font-medium">Shop</a>
            </div>
            
            <!-- Right side icons -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <form action="{{ route('search') }}" method="GET" class="flex-1 max-w-xl mx-4">
                        <div class="relative">
                            <input type="text" 
                                name="query" 
                                placeholder="Cari produk..." 
                                class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                value="{{ request('query') }}"
                                required
                                minlength="2">
                            <button type="submit" class="absolute right-3 top-2 text-gray-500 hover:text-indigo-600">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="text-gray-700 hover:text-indigo-600 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    
                    <!-- Dropdown User -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
                            <i class="fas fa-user text-xl"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                            @auth
                                <a href="/account" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Account</a>
                                <a href="/orders" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Orders</a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-indigo-50">
                                        Logout
                                    </button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Login</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Register</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navbar -->
<nav class="md:hidden bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Left side - Menu button and logo -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-700 focus:outline-none mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="/" class="text-xl font-bold text-indigo-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    GearGalaxy
                </a>
            </div>

            <!-- Right side - Cart and search -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-700 focus:outline-none search-button">
                    <i class="fas fa-search text-xl"></i>
                </button>
                <a href="/cart" class="text-gray-700 relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>
            </div>
        </div>
        
        <!-- Mobile search (hidden by default) -->
        <div class="mobile-search hidden mt-3">
            <form action="{{ route('search') }}" method="GET" class="flex-1 max-w-xl mx-4">
                <div class="relative">
                    <input type="text" 
                        name="query" 
                        placeholder="Cari produk..." 
                        class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ request('query') }}"
                        required
                        minlength="2">
                    <button type="submit" class="absolute right-3 top-2 text-gray-500 hover:text-indigo-600">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>

<!-- Mobile menu (hidden by default) -->
<div class="mobile-menu hidden bg-white shadow-lg rounded-md mx-4 mt-2 py-2 absolute z-50 w-[calc(100%-2rem)]">
    <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Home</a>
    <a href="/shop" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Shop</a>
    
    <div class="border-t border-gray-200 mt-2 pt-2">
        @auth
            <a href="/account" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Account</a>
            <a href="/orders" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Orders</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-indigo-50">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Login</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Register</a>
        @endguest
    </div>
</div>

<!-- JavaScript for mobile menu toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        // Mobile search toggle
        const searchButton = document.querySelector('.search-button');
        const mobileSearch = document.querySelector('.mobile-search');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            // Close search if open
            if (!mobileSearch.classList.contains('hidden')) {
                mobileSearch.classList.add('hidden');
            }
        });

        searchButton.addEventListener('click', function() {
            mobileSearch.classList.toggle('hidden');
            // Close menu if open
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>