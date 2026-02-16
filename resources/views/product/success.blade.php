@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle' , $viewData["subtitle"])
@section('content')
<div class="container">
    <div class="text-center text-success">
        <a href="{{ route('product.create') }}" class="btn btn-primary">
            Return to creation
        </a>
    </div>
</div>
@endsection