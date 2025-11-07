<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(){
        $data['all_products'] = $this->productService->getAllProducts();
        return view('ecommerce.index',$data);
    }
    public function productFilter(Request $request){
        return $this->productService->filter($request);
    }

    public function cartView(){
        return view('ecommerce.cart');
    }
    public function userOrders(){
        return view('ecommerce.order');
    }

}
