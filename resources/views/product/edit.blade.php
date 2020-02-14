@extends('app')

@section('body')

    <div class="w-full max-w-screen-lg mx-auto">

        <div class="bg-white shadow-md rounded px-3 md:px-8 pt-3 md:pt-6 pb-3 md:pb-8 mb-4">

            <div class="mb-4">

                <h2 class="text-blue-600 text-lg font-bold mb-3 border-b border-gray-400 pb-2">Edit {{ $product->name }}</h2>

            </div>

        </div>

    </div>

@endsection
