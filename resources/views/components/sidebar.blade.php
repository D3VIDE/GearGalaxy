<div>
    <div class="w-64 bg-slate-800 p-0 shadow-lg fixed h-screen overflow-y-auto">
        <div class="p-6 border-b border-slate-700">
            <h2 class="text-xl font-extrabold text-slate-100 flex items-center gap-2">
                Galaxy Sparepart
            </h2>
        </div>

        <div class="py-4">
            <a href="{{ route('dashboard') }}"
                class="px-5 py-3 mx-3 rounded-lg  text-white font-medium flex items-center gap-3 cursor-pointer transition-all hover:text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>

                <span>Dashboard</span>
            </a>
            <div class="mt-2">
                <div
                    class="px-5 py-2 mx-3 text-slate-400 text-sm font-medium uppercase tracking-wider flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                    </svg>
                    CATEGORY
                </div>

                <a href="{{ route('category') }}"
                    class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                        class="bi bi-suit-diamond" viewBox="0 0 16 16">
                        <path
                            d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                    </svg>
                    <span class="text-sm">Add Category</span>
                </a>

                <a href="{{ route('ListCategory') }}"
                    class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                        class="bi bi-suit-diamond" viewBox="0 0 16 16">
                        <path
                            d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                    </svg>
                    <span class="text-sm">List Category</span>
                </a>
            </div>
            <!-- Products Group -->
            <div class="mt-2">
                <!-- Group Header -->
                <div
                    class="px-5 py-2 mx-3 text-slate-400 text-sm font-medium uppercase tracking-wider flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                    </svg>

                    PRODUK
                </div>

                <!-- Add Product -->
                <a href="{{ route('addProduk') }}"
                    class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                        class="bi bi-suit-diamond" viewBox="0 0 16 16">
                        <path
                            d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                    </svg>
                    <span class="text-sm">Add Product</span>
                </a>
                <!-- list produk-->
                <a href="{{ route('ListProduk') }}"
                    class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                        class="bi bi-suit-diamond" viewBox="0 0 16 16">
                        <path
                            d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                    </svg>
                    <span class="text-sm">List Produk</span>
                </a>
            </div>

            <div
                class="px-5 py-3 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-slate-200 font-medium flex items-center gap-3 cursor-pointer transition-all">
                <span>Kategori Produk</span>
            </div>

            <div class="mt-2">
            <div
                class="px-5 py-2 mx-3 text-slate-400 text-sm font-medium uppercase tracking-wider flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                VARIAN
            </div>

            <a href="{{ route('addVariant') }}"
                class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                    class="bi bi-suit-diamond" viewBox="0 0 16 16">
                    <path
                        d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                </svg>
                <span class="text-sm">Add Variant</span>
            </a>

            <a href="{{ route('ListVariant') }}"
                class="px-8 py-2 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-blue-500 font-medium flex items-center gap-3 cursor-pointer transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                    class="bi bi-suit-diamond" viewBox="0 0 16 16">
                    <path
                        d="M8.384 1.226a.463.463 0 0 0-.768 0l-4.56 6.468a.54.54 0 0 0 0 .612l4.56 6.469a.463.463 0 0 0 .768 0l4.56-6.469a.54.54 0 0 0 0-.612zM6.848.613a1.39 1.39 0 0 1 2.304 0l4.56 6.468a1.61 1.61 0 0 1 0 1.838l-4.56 6.468a1.39 1.39 0 0 1-2.304 0L2.288 8.92a1.61 1.61 0 0 1 0-1.838z" />
                </svg>
                <span class="text-sm">List Variant</span>
            </a>

            <div
                class="px-5 py-3 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-slate-200 font-medium flex items-center gap-3 cursor-pointer transition-all">
                <span>Atribut Varian</span>
            </div>

            <div
                class="px-5 py-3 mx-3 rounded-lg text-slate-400 hover:bg-slate-700 hover:text-slate-200 font-medium flex items-center gap-3 cursor-pointer transition-all">
                <span>Laporan penjualan</span>
            </div>
        </div>
    </div>
