@extends('layouts.app')
@section('content')

<h1>Admin Dashboard</h1>
<div class="row g-3">

    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <p class="card-text fs-3">{{ $stats['totalOrders'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Revenue</h5>
                <p class="card-text fs-3">₹{{ number_format($stats['totalRevenue'], 2) }}</p>
            </div>
        </div>
    </div>

</div>
@endsection