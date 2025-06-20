<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller

{
    public function index()
    {
        $templates = Template::all();
        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'jenis' => 'required|in:kotak,stiker',
        'image_path' => 'required|image|mimes:jpg,jpeg,png,svg',
        'image_cover' => 'required|image|mimes:jpg,jpeg,png,svg',
        'is_paid' => 'nullable|boolean',
    ]);

    // Simpan gambar utama dan hanya ambil NAMANYA
    $imageName = $request->file('image_path')->hashName(); // otomatis unik
    $request->file('image_path')->move(public_path('storage/img/MOCKUP'), $imageName);

    // Simpan gambar cover (jika ada) dan hanya ambil NAMANYA
    $coverName = null;
    if ($request->hasFile('image_cover')) {
        $coverName = $request->file('image_cover')->hashName();
        $request->file('image_cover')->move(public_path('storage/img/MOCKUP'), $coverName);
    }

    


    Template::create([
        'name' => $request->input('name'),
        'image_path' => $imageName,
        'image_cover' => $coverName,
        'jenis' => $request->input('jenis'),
        'is_paid' => $request->boolean('is_paid'),
    ]);

    return redirect()->route('templates.index')->with('success', 'Template berhasil ditambahkan.');
}




   public function edit($id)
{
    $template = Template::findOrFail($id);
    return view('admin.templates.edit', compact('template'));
}

public function update(Request $request, $id)
{
    // dd($request->is_paid);
    $request->validate([
        'name' => 'required|string|max:255',
        'jenis' => 'required|in:kotak,stiker',
        'image_path' => 'nullable|image|mimes:jpg,jpeg,png,svg',
        'image_cover' => 'nullable|image|mimes:jpg,jpeg,png,svg',
        'is_paid' => 'boolean',
    ]);

    $template = Template::findOrFail($id);

    // Ganti gambar utama jika diupload
    if ($request->hasFile('image_path')) {
        if ($template->image_path && file_exists(public_path('storage/img/MOCKUP/' . $template->image_path))) {
            unlink(public_path('storage/img/MOCKUP/' . $template->image_path));
        }
        $imageName = $request->file('image_path')->hashName();
        $request->file('image_path')->move(public_path('storage/img/MOCKUP'), $imageName);
        $template->image_path = $imageName;
    }

    // Ganti cover jika diupload
    if ($request->hasFile('image_cover')) {
        if ($template->image_cover && file_exists(public_path('storage/img/MOCKUP/' . $template->image_cover))) {
            unlink(public_path('storage/img/MOCKUP/' . $template->image_cover));
        }
        $coverName = $request->file('image_cover')->hashName();
        $request->file('image_cover')->move(public_path('storage/img/MOCKUP'), $coverName);
        $template->image_cover = $coverName;
    }

    // Update data lain
    $template->name = $request->input('name');
    $template->jenis = $request->input('jenis');
    $template->is_paid = $request->boolean('is_paid');
    $template->save();

    return redirect()->route('templates.index')->with('success', 'Template berhasil diperbarui.');
}

   public function destroy($id)
{
    $template = Template::findOrFail($id);

    // Hapus file gambar
    if ($template->image_path && file_exists(public_path('storage/img/MOCKUP/' . $template->image_path))) {
        unlink(public_path('storage/img/MOCKUP/' . $template->image_path));
    }

    if ($template->image_cover && file_exists(public_path('storage/img/MOCKUP/' . $template->image_cover))) {
        unlink(public_path('storage/img/MOCKUP/' . $template->image_cover));
    }

    $template->delete();

    return redirect()->route('templates.index')->with('success', 'Template berhasil dihapus.');
}
}
