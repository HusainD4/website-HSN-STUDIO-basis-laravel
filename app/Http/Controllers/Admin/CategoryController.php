<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.admin_category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:categories,slug',
            'brand_name' => 'nullable|string|max:255',
        ]);

        Category::create($request->only('name', 'slug', 'brand_name'));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'brand_name' => 'nullable|string|max:255',
        ]);

        $category->update($request->only('name', 'slug', 'brand_name'));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus');
    }

    /**
     * Sync category with external API (PHB UMKM).
     */
    public function sync($id, Request $request)
{
    $category = Category::findOrFail($id);

    try {
        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => (bool) $request->is_active,
        ]);
    } catch (\Exception $e) {
        session()->flash('errorMessage', 'Terjadi kesalahan saat menghubungi API.');
        return redirect()->back();
    }

    if ($response->successful() && isset($response['product_category_id'])) {
        $category->hub_category_id = $request->is_active ? $response['product_category_id'] : null;
        $category->save();

        session()->flash('successMessage', 'Kategori berhasil disinkronkan.');
    } else {
        session()->flash('errorMessage', 'Gagal menyinkronkan kategori.');
    }

    return redirect()->back();
}
    /**
     * Toggle the active status of the category.
     */
    public function toggle(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        return back()->with('success', 'Status kategori berhasil diubah.');
    }
}
