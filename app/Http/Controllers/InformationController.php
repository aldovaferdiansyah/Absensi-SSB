<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    public function index()
    {
        $information = Information::all();

        return view('information.v_information', compact('information'));
    }

    public function create()
    {
        return view('information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'heading.required' => 'Judul Wajib Diisi !!',
            'description.required' => 'Deskripsi Wajib Diisi !!',
        ]);

        Information::create([
            'heading' => $request->heading,
            'description' => $request->description,
        ]);

        return redirect()->route('information.index')->with('success', 'Informasi Telah Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $information = Information::findOrFail($id);
        return view('information.edit', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'heading.required' => 'Judul Wajib Diisi !!',
            'description.required' => 'Deskripsi Wajib Diisi !!',
        ]);

        $information = Information::findOrFail($id);
        $information->update($request->only(['heading', 'description']));

        return redirect()->route('information.index')->with('success', 'Informasi Telah Berhasil Diubah.');
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('information.index')->with('success', 'Informasi Telah Berhasil Dihapus.');
    }
}
