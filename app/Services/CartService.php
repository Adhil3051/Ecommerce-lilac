<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartService
{

    public function addToCart($userId, $productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            throw new \Exception("Not enough stock for {$product->name}");
        }

        $product->stock -= $quantity;
        $product->save();

        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        $cartItem = CartItems::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $productId
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->save();

        return $cart->load('items.product');
    }

    public function getUserCart($userId)
    {
        $cart = Cart::where('user_id', $userId)
            ->with('items.product') // eager load products
            ->first();

        if (!$cart) {
            // return empty structure if no cart
            return [
                'id' => null,
                'user_id' => $userId,
                'items' => [],
            ];
        }

        return $cart;
    }

    public function updateQuantity($userId, $cartItemId, $newQuantity)
    {
        return DB::transaction(function () use ($userId, $cartItemId, $newQuantity) {

            $cartItem = CartItems::where('id', $cartItemId)
                ->whereHas('cart', fn($q) => $q->where('user_id', $userId))
                ->with('product')
                ->firstOrFail();

            $product = $cartItem->product;

            // Calculate difference to adjust stock
            $difference = $newQuantity - $cartItem->quantity;

            // Check stock availability
            if ($difference > 0 && $product->stock < $difference) {
                throw new \Exception("Not enough stock for {$product->name}");
            }

            // Update product stock
            $product->stock -= $difference;
            $product->save();

            // Update cart item quantity
            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            // Return the updated cart with items
            $cart = Cart::where('user_id', $userId)->with('items.product')->first();

            return $cart;
        });
    }
    public function removeCartItem($userId, $cartItemId)
    {
        return DB::transaction(function () use ($userId, $cartItemId) {
            $cartItem = CartItems::where('id', $cartItemId)
                ->whereHas('cart', fn($q) => $q->where('user_id', $userId))
                ->with('product')
                ->firstOrFail();

            $product = $cartItem->product;

            // Restore stock
            $product->stock += $cartItem->quantity;
            $product->save();

            $cartItem->delete();

            // Return updated cart
            $cart = Cart::where('user_id', $userId)->with('items.product')->first();

            return $cart;
        });
    }

    public function placeOrder($userId)
    {
        return DB::transaction(function () use ($userId) {

            $cart = Cart::where('user_id', $userId)->with('items.product')->firstOrFail();

            if (!$cart->items->count()) {
                throw new \Exception("Cart is empty");
            }

            $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

            $order = Order::create([
                'user_id' => $userId,
                'total' => $total
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;

                if ($item->quantity > $product->stock) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price
                ]);

                // Reduce stock
                $product->stock -= $item->quantity;
                $product->save();
            }

            $cart->items()->delete();

            return $order->load('items.product');
        });
    }
    public function getOrdersByUser($userId)
    {
        // Fetch orders with related items and products
        return Order::where('user_id', $userId)
                    ->with('items.product') // eager load related items and products
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
