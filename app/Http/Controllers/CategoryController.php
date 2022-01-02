<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category/index', ['categories' => $categories]);
        $response = Http::get('http://localhost:3000/api/kategori/' . $categories->id,);
        $jsonDatas = $response->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('category/create', compact('categories'));
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

            //create category di api
            $response = Http::post('http://localhost:3030/api/kategori/', [
                'kategoriID' => $categories->id,
                'nama' => $request->nama,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('categories')->with('error', 'Terjadi Kesalahan');
        };
        return redirect('categories')->with('status', 'Kategori berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // $category->makeHidden(['kategori_id']);
        return view('category/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $categories = Category::whereId($id)->first();
            $categories->update([
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
            //update category tabel di api
            $response = Http::patch('http://localhost:3030/api/kategori/' . $categories->id, [
                'kategoriID' => $categories->id,
                'nama' => $request->nama,
            ]);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return redirect('categories')->with('error', 'Terjadi Kesalahan');
        };
        return redirect('categories')->with('status', 'Kategori berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::whereId($id)->first();
        $response = Http::delete('http://localhost:3030/api/kategori/' . $category->id);
        $category->delete();

        return redirect('categories')->with('status', 'Kategori berhasil dihapus!');
    }
}
