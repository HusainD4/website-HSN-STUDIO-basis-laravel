<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Menampilkan daftar semua feedback (admin).
     */
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('admin.feedbacks.admin_feedback', compact('feedbacks'));
    }

    /**
     * Menampilkan detail feedback tertentu (admin).
     */
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Menghapus feedback tertentu (admin).
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
