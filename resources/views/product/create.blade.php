@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create product</div>
          <div class="card-body">
            @if($errors->any()) <!-- Show all errors in this variable (According to the validate in the controller, which saves errors in the varibale called errors).
            This also saves old data of the forms in old() -->
            <ul id="errors" class="alert alert-danger list-unstyled"> 
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif


            <form method="POST" action="{{ route('product.save') }}">
              <!-- Needed token for validation - If the token is not put, 419 error will appear-->
              @csrf 
              <input type="text" class="form-control mb-2" placeholder="Enter name" name="name" value="{{ old('name') }}" /> <!-- Old is used if there is a error, values are kept -->
              <input type="text" class="form-control mb-2" placeholder="Enter price" name="price" value="{{ old('price') }}" />
              <input type="submit" class="btn btn-primary" value="Send" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
