<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    // Tampilkan list semua service
    public function index()
    {
        $services = Service::all();
        return view('admin.servicess.admin_services', compact('services'));
    }

    // Form tambah service baru
    public function create()
    {
        return view('admin.servicess.add_services');
    }

    // Simpan service baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only('name', 'description', 'price');

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image_url'] = $path;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service berhasil ditambahkan.');
    }

    // Form edit service
    public function edit(int $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.servicess.edit_services', compact('service'));
    }

    // Update data service
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $data = $request->only('name', 'description', 'price');

        // Handle update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
                Storage::disk('public')->delete($service->image_url);
            }
            // Upload gambar baru
            $path = $request->file('image')->store('services', 'public');
            $data['image_url'] = $path;
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service berhasil diperbarui.');
    }

    // Hapus service
    public function destroy(int $id)
    {
        $service = Service::findOrFail($id);

        // Hapus gambar jika ada
        if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
            Storage::disk('public')->delete($service->image_url);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service berhasil dihapus.');
    }
}
