<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;


class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Level::orderBy('id', 'desc')->get();
        $title = "Data Level";
        return view('level.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Level";
        return view('level.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Level::create($request->all());
        return redirect()->to('level');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = Level::find($id); //blank
        $level = "Ubah Level";
        // $level = Level::findOrFail($id); //404
        // $level = Level::where('id', $id)->first();
        return view('level.edit', compact('level', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $level = Level::find($id);
        $level->name = $request->name;
        $level->save();
        return redirect()->to('level')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->to('level')->with('success', 'Data Berhasil Diubah');
    }
}
