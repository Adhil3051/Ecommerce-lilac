<?php
namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductService
{

    public function addProduct(array $data, ?int $id = null): bool
    {
        try {
            $product = $id ? Product::findOrFail($id) : new Product();

            $product->fill([
                'name'        => $data['name'],
                'description' => $data['description'] ?? null,
                'price'       => $data['price'],
                'stock'       => $data['stock'],
            ]);

            $product->save();
            return true;
        } catch (Exception $e) {
            Log::error('Error adding product', [
                'error' => $e->getMessage(),
                'data'  => $data,
            ]);
            return false;
        }
    }
    public function getAllProducts()
    {
        return Product::all();
    }
    public function getProductById($id)
    {

        return Product::find($id);
    }
    public function deleteProductById($id)
    {
        try {
            $p = Product::findOrFail($id);
            $p->delete();
            return true;
        } catch (\Throwable $e) {
            Log::error('Error deleting product', [
                'id'    => $id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }

    }
    public function filter($request)
    {
        $filters = $request->only(['min_price', 'max_price']);
        $query   = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $filters['max_price']);
        }

        return response()->json($query->get());
    }
    public function getProducts($perPage = 10)
    {
        return Product::orderBy('created_at', 'desc')->paginate($perPage);
    }

}
