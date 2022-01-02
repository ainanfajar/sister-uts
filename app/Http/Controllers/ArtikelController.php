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
        $categories = Category::all();
        return view('artikel/index', [
            'artikels' => $artikels,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('artikel/create', ['categories' => $categories]);
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

            // $categories = new Category;
            // $categories->nama = $request->nama;
            // $categories->save();

            // $artikels = new Artikel;
            // $artikels->kategori_id = $request->category;
            // $artikels->judul = $request->judul;
            // $artikels->isi = $request->isi;
            // $artikels->save();
            // dd($request->nama);
            $artikels = Artikel::create([
                'kategori_id' => $request->nama,
                'judul' => $request->judul,
                'isi' => $request->isi,
            ]);
            $artikels->save();

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
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
    public function edit($id)
    {
        $artikel = Artikel::find($id);
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
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            // $artikels = Artikel::find($request->id);

            // dd($artikels);
            $artikels = Artikel::whereId($id)->first();
            $artikels->update([
                'judul' => $request->judul,
                'kategori_id' => $request->nama,
                'isi' => $request->isi,
            ]);

            // $categories = new Category;
            // $categories->id = $request->nama;
            // $categories->save();

            // $artikels = new Artikel;
            // $artikels->judul = $request->judul;
            // $artikels->kategori_id = $request->nama;
            // $artikels->isi = $request->isi;
            // $artikels->save();

            DB::commit();
        } catch (\Throwable $th) {
            // dd($th);
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
