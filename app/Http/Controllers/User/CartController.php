<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }
    public function addToCart(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $user = $request->user();
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $cart = $this->cartService->addProduct($user->id, $productId, $quantity);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart' => $cart
        ]);

    }
}
