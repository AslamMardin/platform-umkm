<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Design;


class AppController extends Controller
{
   public function welcome()
{
   

    return view('welcome');
}
    public function template()
    {
       $templates = Template::all();
    
        // Kirim ke view
        return view('template', compact('templates'));
    }
    public function editor($id = null)
{
    $user = Auth::user();

    // Ambil template sesuai level user
    $templates = $user && $user->is_premium
        ? Template::all()
        : Template::where('is_paid', false)->get();

    $project = null;

    if ($id) {
        $project = \App\Models\Design::where('user_id', $user->id)->findOrFail($id);
    }

    return view('editor', compact('templates', 'project'));
}


    public function store(Request $request)
{
    $request->validate([
        'template_id' => 'required|integer|exists:templates,id',
        'canvas_json' => 'required|string',
        'image_path'  => 'required|string',
    ]);

    $path = null;

    // 🖼️ Simpan base64 image jika dikirim
    if (str_starts_with($request->image_path, 'data:image')) {
        $imageData = $request->image_path;
        $imageName = 'design_' . time() . '.png';
        $path = 'projects/' . $imageName;

        Storage::disk('public')->put($path, base64_decode(
            preg_replace('#^data:image/\w+;base64,#i', '', $imageData)
        ));
    }

    if ($request->filled('project_id')) {
        // 🔁 Update project yang sudah ada
        $project = Design::where('user_id', Auth::id())
                         ->findOrFail($request->project_id);

        $project->update([
            'template_id' => $request->template_id,
            'canvas_json' => $request->canvas_json,
            'image_path'  => $path ?? $project->image_path,
        ]);
    } else {
        // 🆕 Buat project baru
        Design::create([
            'user_id'     => Auth::id(),
            'template_id' => $request->template_id,
            'canvas_json' => $request->canvas_json,
            'image_path'  => $path,
        ]);

        // ➕ Tambahkan usage_count template (jika baru)
        Template::where('id', $request->template_id)->increment('usage_count');
    }

    return redirect()->route('project')->with('success', 'Project berhasil disimpan!');
}


public function destroy($id)
{
    $project = \App\Models\Design::where('user_id', Auth::id())->findOrFail($id);

    // Hapus file gambar jika ada
    if (Storage::disk('public')->exists($project->image_path)) {
        Storage::disk('public')->delete($project->image_path);
    }

    $project->delete();

    return redirect()->route('project')->with('success', 'Project berhasil dihapus.');
}
}
