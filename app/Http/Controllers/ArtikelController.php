<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $artikels = Artikel::with('category')->get();
        return view('artikel/index', ['artikels' => $artikels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('artikel/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $categories = new Category;
            $categories->nama = $request->nama;
            $categories->save();

            $artikels = new Artikel;
            $artikels->kategori_id = $categories->id;
            $artikels->judul = $request->judul;
            $artikels->isi = $request->isi;
            $artikels->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('artikels')->with('error', 'Terjadi Kesalahan');
        };
        return redirect('artikels')->with('status', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        $artikel->makeHidden(['kategori_id']);
        return view('artikel/show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        $categories = Category::all();
        return view('artikel.edit', compact('artikel', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        DB::beginTransaction();
        try {

            Artikel::where('id', $artikel->id)
                ->update([
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'nama' => $request->nama,
                ]);

            // $categories = new Category;
            // $categories->nama = $request->nama;
            // $categories->save();

            // $artikels = new Artikel;
            // $artikels->kategori_id = $categories->id;
            // $artikels->judul = $request->judul;
            // $artikels->isi = $request->isi;
            // $artikels->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('artikels')->with('error', 'Terjadi Kesalahan');
        };
        return redirect('artikels')->with('status', 'Artikel berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect('artikels')->with('status', 'Artikel berhasil dihapus!');
    }
}
