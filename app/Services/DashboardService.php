<?php
namespace App\Services;
use App\Models\Order;

class DashboardService{

    public function getStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');

        return [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
        ];
    }

    public function getRecentOrders($limit = 5)
    {
        return Order::with('items.product', 'user')
                    ->latest()
                    ->take($limit)
                    ->get();
    }
}