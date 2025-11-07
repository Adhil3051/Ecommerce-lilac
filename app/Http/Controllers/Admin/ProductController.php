<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{   
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data['all_products'] = $this->productService->getProducts(10);

        return view('admin.product.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.product.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validData = $request->validated();
        if($this->productService->addProduct($validData)){
            return redirect()->route('admin.products')->with('success','Product Added Successfully');
        }
        return redirect()->back()->with('error','Product Added Failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $data['product'] = $this->productService->getProductById(decrypt($id));
        return view('admin.product.show',$data);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //
        $data = $request->validated();
        if($this->productService->addProduct($data,decrypt($id))){
            return redirect()->back()->with('success','Product Updated Successfully');
        }
            return redirect()->back()->with('error','Product Updation Failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->productService->deleteProductById(decrypt($id))){
            return redirect()->route('admin.products')->with('success','Product Deleted Successfully');
        }
        return redirect()->back()->with('error','Product Deletion Failed');
    }
}
