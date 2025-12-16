@extends('components.layout')

@section('categories')
    <div id="react-product-user" data-categorie-id="{{ request()->id }}"></div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
