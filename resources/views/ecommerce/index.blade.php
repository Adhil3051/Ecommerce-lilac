{{-- @extends('layouts.ecommerce')

@section('content')
<div id="app" class="container py-4">
    <div class="row g-3">
        <div class="col-md-3">
            <product-filter @filter-changed="updateFilters"></product-filter>
        </div>
        <div class="col-md-9">
            <product-list :initial-products='@json($all_products)' :is-auth='@json(Auth::check())' :filters="filters"></product-list>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.ecommerce')

@section('content')
<div id="app" class="container-fluid py-4">
    <div class="row g-3">
        <div class="col-md-3">
            <product-filter @filter-changed="updateFilters"></product-filter>
        </div>
        <div class="col-md-9">
            <product-list 
                :initial-products='@json($all_products)' 
                :is-auth='@json(Auth::check())' 
                :filters="filters">
            </product-list>
        </div>
    </div>
</div>
@endsection
