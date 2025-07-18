<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;

class ProductCategoryController extends Controller
{
    public function sync($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => (bool) $request->is_active,
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $request->is_active ? $response['product_category_id'] : null;
            $category->save();

            session()->flash('successMessage', 'Kategori berhasil disinkronkan.');
        } else {
            session()->flash('errorMessage', 'Gagal menyinkronkan kategori.');
        }

        return redirect()->back();
    }
}
