<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $barang = Barang::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('admin.barang.index', compact('barang', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('barang_images', 'public');
        }

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang->update([
            'nama' => $validated['nama'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'id_kategori' => $validated['id_kategori'],
        ]);

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::delete('public/' . $barang->foto);
            }

            $barang->foto = $request->file('foto')->store('barang_images', 'public');
            $barang->save();
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diedit!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::delete('public/' . $barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
