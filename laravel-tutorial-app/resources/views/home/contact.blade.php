@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container">
  <div class="row">
    <div class="text-center">
        <p class="lead mb-1">{{ $viewData["name"] }}</p>
        <p class="lead mb-1">{{ $viewData["email"] }}</p>
        <p class="lead mb-0">{{ $viewData["phone"] }}</p>
    </div>
  </div>
</div>
@endsection