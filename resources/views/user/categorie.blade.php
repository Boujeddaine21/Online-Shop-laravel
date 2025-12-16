@extends('components.layout')

@section('categories')
<h1 class="text-3xl font-bold text-gray-300 mb-6 ml-30">All Categories</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 p-10 mx-20">

    @foreach ($categories as $categorie)
        <a href="/shop/categorie/{{ $categorie->id }}/products">
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 p-4 cursor-pointer transform hover:-translate-y-1">
            <div class="w-full h-56 flex items-center justify-center  rounded-xl overflow-hidden">
                <img
                    src="/images/{{ $categorie->description }}"
                    alt="{{ $categorie->name }}"
                    class="object-contain h-60 drop-shadow-lg"
                >
            </div>
            <div class="text-center">
                <h2 class="text-xl font-bold text-gray-800 tracking-wide">
                    {{ $categorie->name }}
                </h2>
            </div>

        </div>
        </a>
    @endforeach

</div>

@endsection
