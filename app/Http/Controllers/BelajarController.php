<?php

namespace App\Http\Controllers;

use App\Models\Count;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        // return $this->callName();
        // return "Ini belajar laravel";
        return view('aritmatika');
    }

    public function tambah()
    {
        $title = "Penambahan";
        $jumlah = 0;
        $error = null;
        return view('tambah', compact('title', 'jumlah'));
    }

    public function tambahAction(Request $request)
    {
        $request->validate([
            'angka1' => 'numeric|required',
            'angka2' => 'numeric|required',
        ]);

        $angka1 = $request->angka1;
        $angka2 = $request->input('angka2');
        $error = null;
        $jumlah = null;

        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            $error = "Data Harus Numeric";
        } else {
            $jumlah = $angka1 + $angka2;
        }
        if ($error = null) {
            Count::create([
                'jenis' => $request->jenis,
                'angka1' => $angka1,
                'angka2' => $angka2,
                'hasil' => $jumlah,
            ]);
            return view('tambah', compact('jumlah', 'error'));
        }
    }

    public function update($name)
    {
        return "Selamat Datang $name";
    }
}
