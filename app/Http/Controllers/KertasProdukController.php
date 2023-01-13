<?php

namespace App\Http\Controllers;

use App\Models\OffsetJenisKertas;
use App\Models\OffsetKertasProduk;
use App\Models\OffsetProduk;
use Illuminate\Http\Request;

class KertasProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kertas_produks = OffsetKertasProduk::with(['kertas', 'produk'])->orderBy('id', 'desc')->get();

        return view('pages.kertas_produk.index', ['kertas_produks' => $kertas_produks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kertas = OffsetJenisKertas::get();
        $produks = OffsetProduk::get();

        return view('pages.kertas_produk.create',['kertas' => $kertas, 'produks' => $produks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kertas_id' => 'required',
            'produk_id' => 'required'
        ]);

        $kertas_produks = new OffsetKertasProduk;
        $kertas_produks->kertas_id = $request->kertas_id;
        $kertas_produks->produk_id = $request->produk_id;
        $kertas_produks->save();

        return redirect()->route('kertas_produk.index')->with('status', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kertas_produk = OffsetKertasProduk::find($id);
        $kertas = OffsetJenisKertas::get();
        $produks = OffsetProduk::get();

        return view('pages.kertas_produk.edit', [
            'kertas_produk' => $kertas_produk,
            'kertas' => $kertas,
            'produks' => $produks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kertas_id' => 'required',
            'produk_id' => 'required'
        ]);

        $kertas_produks = OffsetKertasProduk::find($id);
        $kertas_produks->kertas_id = $request->kertas_id;
        $kertas_produks->produk_id = $request->produk_id;
        $kertas_produks->save();

        return redirect()->route('kertas_produk.index')->with('status', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $kertas_produk = OffsetKertasProduk::find($id);
        $kertas_produk->delete();

        return redirect()->route('kertas_produk.index')->with('status', 'Data berhasil dihapus');
    }
}
