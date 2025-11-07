@extends('layouts.app')

@section('content')
<div class="container py-4">



    <h4 class="mt-5">Recent Orders</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Order ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>₹{{ $order->total }}</td>
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
    
@endsection