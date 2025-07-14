<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Menampilkan semua data kritik dan saran.
     */
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('hsnstudio.kontak.kritiksaran_index', compact('feedbacks'));
    }

    /**
     * Menampilkan form untuk mengirim kritik dan saran.
     */
    public function create()
    {
        return view('hsnstudio.kontak.kritiksaran_create');
    }

    /**
     * Menyimpan data kritik dan saran yang dikirim oleh user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas kritik dan sarannya!');
    }

    /**
     * Menampilkan detail satu data kritik dan saran.
     */
    public function show(string $id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('hsnstudio.kontak.kritiksaran_show', compact('feedback'));
    }

    /**
     * Menghapus satu data kritik dan saran berdasarkan ID.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('kritiksaran.index')->with('success', 'Data kritik dan saran berhasil dihapus.');
    }
    public function adminIndex()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('admin.feedbacks.admin_feedback', compact('feedbacks'));
    }

}
