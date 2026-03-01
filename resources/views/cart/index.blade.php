@extends('layouts.app')
@section("title", 'Cart - Online Store')
@section("subtitle", 'Shopping Cart')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Available products</h1>
            <ul>
                @foreach($viewData["products"] as $key => $product) {{-- Get the key and the value, in this case key as the key and the value as product --}}
                    <li>
                    Id: {{ $key }} -
                    Name: {{ $product["name"] }} -
                    Price: {{ $product["price"] }} -
                    <a href="{{ route('cart.add', ['id'=> $key]) }}">Add to cart</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Products in cart</h1>
            <ul>
                @foreach($viewData["cartProducts"] as $key => $product) {{-- Get the key and the value, in this case key as the key and the value as product --}}
                    <li>
                    Id: {{ $key }} -
                    Name: {{ $product["name"] }} -
                    Price: {{ $product["price"] }}
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('cart.removeAll') }}">Remove all products from cart</a>
        </div>
    </div>
</div>

@endsection