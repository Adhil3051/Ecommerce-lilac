
@extends('layouts.ecommerce')
@push('styles')
<style>
    body{
        background-color: lightgray;
    }
</style>
    
@endpush
@section('content')
{{-- <div class="container d-flex justify-content-center align-items-center min-vh-100">
  <form method="POST" action="{{ route('user-login') }}" class="p-4 border rounded-3 shadow-lg bg-white" style="width: 350px;">
    @csrf
    <h3 class="text-center mb-4">Login</h3>

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name">
      @error('name')
        <span class="text-danger">{{ $message }}</span>       
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
      @error('password')
        <span class="text-danger">{{ $message }}</span>       
      @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div> --}}
<div id="app">
  <user-login-form></user-login-form>
</div>
@endsection