<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function add(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        try {
            $user = $request->user();
            $quantity = $request->quantity ?? 1;
            $cart = $this->cartService->addToCart($user->id, $request->product_id, $quantity);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function view(Request $request)
    {
        $user = $request->user();
        $cart = $this->cartService->getUserCart($user->id);

        return response()->json($cart);
    }
    public function cartUpdate(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = $request->user();

        try {
            $cart = $this->cartService->updateQuantity($user->id, $request->cart_item_id, $request->quantity);

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function removeItem(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id'
        ]);

        $user = $request->user();

        try {
            $cart = $this->cartService->removeCartItem($user->id, $request->cart_item_id,);

            return response()->json([
                'success' => true,
                'message' => 'Item Removed successfully',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function placeOrder(Request $request)
    {
        $user = $request->user();

        try {
            $order = $this->cartService->placeOrder($user->id);

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getUserOrder(Request $request)
    {
        $user = $request->user();

        $orders = $this->cartService->getOrdersByUser($user->id);

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
}
