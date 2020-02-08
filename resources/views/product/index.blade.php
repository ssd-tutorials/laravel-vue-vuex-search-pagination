@extends('app')

@section('body')

    <div class="w-full max-w-screen-lg mx-auto">

        <div class="bg-white shadow-md rounded px-3 md:px-8 pt-3 md:pt-6 pb-3 md:pb-8 mb-4">

            <div class="mb-4">

                <h2 class="text-blue-600 text-lg font-bold mb-3 border-b border-gray-400 pb-2">Products</h2>

                <!-- SEARCH FORM -->

                <form class="grid grid-cols-8 col-gap-4 pb-3 border-b border-gray-400">
                    <div class="col-span-8 md:col-span-4">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                            Search
                        </label>
                        <div class="relative">
                            <span class="absolute top-0 right-0 mt-4 mr-4 text-gray-500 cursor-pointer">
                                <times-circle class="fill-current h-4 pointer-events-none"></times-circle>
                            </span>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="appearance-none block w-full bg-gray-200 focus:bg-white text-gray-700 border border-gray-400 focus:border-gray-500 rounded-sm py-3 pl-4 pr-10 mb-3 md:mb-0 leading-tight focus:outline-none"
                                placeholder="Search..."
                            >
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <label
                            for="order_by"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        >
                            Order by
                        </label>
                        <div class="relative">
                            <select
                                id="order_by"
                                class="appearance-none block w-full bg-gray-200 focus:bg-white text-gray-700 border border-gray-400 focus:border-gray-500 rounded-sm py-3 pl-4 pr-8 leading-tight focus:outline-none"
                            >
                                <option value="name:asc">Name ASC</option>
                                <option value="name:desc">Name DESC</option>
                                <option value="price:asc">Price ASC</option>
                                <option value="price:desc">Price DESC</option>
                            </select>
                            <select-angle></select-angle>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-2">
                        <label
                            for="per_page"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        >
                            Per page
                        </label>
                        <div class="relative">
                            <select
                                id="per_page"
                                class="appearance-none block w-full bg-gray-200 focus:bg-white text-gray-700 border border-gray-400 focus:border-gray-500 rounded-sm py-3 pl-4 pr-8 leading-tight focus:outline-none"
                            >
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="60">60</option>
                                <option value="100">100</option>
                            </select>
                            <select-angle></select-angle>
                        </div>
                    </div>
                </form>

                <!--/ SEARCH FORM -->


                <!-- RESULTS -->

                <div class="text-sm">

                    <div class="flex flex-wrap p-4 bg-gray-700 text-white rounded-sm">
                        <div class="flex-auto pr-3">
                            Total records: 0
                        </div>
                    </div>

                    <div class="flex flex-wrap p-4 border-b border-dashed border-gray-400 text-gray-700 hover:bg-gray-100">
                        <div class="flex-auto pr-3">
                            Product name
                        </div>
                        <div class="flex-shrink">
                            <a href="/" class="inline-block mr-3 text-green-500">
                                Edit
                            </a>
                            <a href="/" class="inline-block text-red-500">
                                Remove
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-wrap p-4 border-b border-dashed border-gray-400 text-gray-700 hover:bg-gray-100">
                        <div class="flex-auto pr-3">
                            Product name
                        </div>
                        <div class="flex-shrink">
                            <a href="/" class="inline-block mr-3 text-green-500">
                                Edit
                            </a>
                            <a href="/" class="inline-block text-red-500">
                                Remove
                            </a>
                        </div>
                    </div>

                </div>

                <!--/ RESULTS -->


                <!-- PAGINATION -->

                <form class="w-full md:w-1/3 mx-auto mt-3 grid grid-cols-5 gap-0 text-gray-700">
                    <span class="row-span-1 flex items-center justify-center border border-gray-400 rounded-l-sm cursor-pointer">
                        <double-angle-left class="fill-current h-4 pointer-events-none"></double-angle-left>
                    </span>
                    <span class="row-span-1 flex items-center justify-center border-t border-b border-gray-400 cursor-pointer">
                        <angle-left class="fill-current h-4 pointer-events-none"></angle-left>
                    </span>
                    <span class="row-span-1 relative">
                        <select
                            id="per_page"
                            class="appearance-none rounded-none block w-full bg-gray-200 focus:bg-white text-gray-700 border border-gray-400 focus:border-gray-500 py-3 pl-4 pr-8 leading-tight focus:outline-none"
                        >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <select-angle></select-angle>
                    </span>
                    <span class="row-span-1 flex items-center justify-center border-t border-b border-gray-400 cursor-pointer">
                        <angle-right class="fill-current h-4 pointer-events-none"></angle-right>
                    </span>
                    <span class="row-span-1 flex items-center justify-center border border-gray-400 rounded-r-sm cursor-pointer">
                        <double-angle-right class="fill-current h-4 pointer-events-none"></double-angle-right>
                    </span>
                </form>

                <!--/ PAGINATION -->

            </div>

        </div>

    </div>

@endsection
