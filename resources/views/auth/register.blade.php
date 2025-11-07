
@extends('layouts.ecommerce')
@push('styles')
<style>
    body{
        background-color: lightgray;
    }
</style>
    
@endpush
@section('content')

<div id="app">
  <register-view></register-view>
</div>
@endsection