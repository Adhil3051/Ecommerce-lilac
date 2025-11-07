<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class HomeController extends Controller
{
    //
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index(){
        $data['stats'] = $this->dashboardService->getStats();
        return view('admin.home.dashboard',$data);
    }
    public function Orders(){
        $data['recentOrders'] = $this->dashboardService->getRecentOrders();
        return view('admin.order.index',$data);
    }
}
