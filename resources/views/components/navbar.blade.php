    <!-- Desktop Navbar -->
    <nav class="hidden md:block bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">ShopName</a>
                </div>
                <!-- Main Navigation -->
                <div class="flex items-center justify-center">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 font-medium  px-4">Home</a>
                    <a href="/shop" class="text-gray-700 hover:text-indigo-600 font-medium  px-4">Shop</a>
                    <a href="/about" class="text-gray-700 hover:text-indigo-600 font-medium  px-4">About</a>
                    <a href="/contact" class="text-gray-700 hover:text-indigo-600 font-medium px-4">Contact</a>
                </div>
                <!-- Right side icons -->
                <div class="flex items-center space-x-6">
                    <div class="relative hidden lg:block">
                        <input type="text" placeholder="Search..."
                            class="py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64">
                        <button class="absolute right-4 top-1/3 transform -translate-y-1/4 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <a href="/wishlist" class="text-gray-700 hover:text-indigo-600">
                        <i class="far fa-heart text-xl"></i>
                    </a>
                    <a href="/cart" class="text-gray-700 hover:text-indigo-600 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>
                    <!-- Dropdown User -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Tombol Icon User -->
                        <button @click="open = !open" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
                            <i class="fas fa-user text-xl"></i>
                        </button>

                        <!-- Menu Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                            <a href="/account" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Account</a>
                            <a href="/orders" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Orders</a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <a href="{{route('login')}}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Login</a>
                            <a href="/auth/register"
                                class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Register</a>
                            <a href="/auth/logout" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>


    <!-- Mobile Navbar -->
    <nav class="header-mobile header_sticky fixed top-0 left-0 right-0 bg-white shadow-md z-50 md:hidden">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Left side - Menu button and logo -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 focus:outline-none mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="/" class="text-xl font-bold text-indigo-600">ShopName</a>
                </div>

                <!-- Right side - Search, cart, user -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 focus:outline-none search-button">
                        <i class="fas fa-search text-xl"></i>
                    </button>

                    <a href="/cart" class="text-gray-700 relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </a>

                    <!-- User dropdown (mobile) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-700 focus:outline-none">
                            <i class="fas fa-user text-xl"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 top-10 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                            <a href="/account" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Account</a>
                            <a href="/orders" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">My Orders</a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <a href="/auth/login" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Login</a>
                            <a href="/auth/register"
                                class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Register</a>
                            <a href="/auth/logout" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <!-- Mobile menu (hidden by default) -->
    <div class="mobile-menu hidden mt-4 pb-4">
        <a href="/" class="block py-2 text-gray-700 hover:text-indigo-600">Home</a>
        <a href="/shop" class="block py-2 text-gray-700 hover:text-indigo-600">Shop</a>
        <a href="/about" class="block py-2 text-gray-700 hover:text-indigo-600">About</a>
        <a href="/contact" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
        <div class="border-t border-gray-200 mt-2 pt-2">
            <a href="/login" class="block py-2 text-gray-700 hover:text-indigo-600">Login</a>
            <a href="/register" class="block py-2 text-gray-700 hover:text-indigo-600">Register</a>
        </div>
    </div>

    <!-- Mobile search (hidden by default) -->
    <div class="mobile-search hidden mt-4">
        <div class="relative">
            <input type="text" placeholder="Search products..."
                class="w-full py-2 px-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button class="absolute right-3 top-2 text-gray-500">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    </div>
    </nav>

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
                mobileSearch.classList.add('hidden');
            });

            searchButton.addEventListener('click', function() {
                mobileSearch.classList.toggle('hidden');
                mobileMenu.classList.add('hidden');
            });
        });
    </script>