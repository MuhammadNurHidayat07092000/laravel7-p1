<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdulevelController extends Controller
{
    public function data()
    {
        $edulevel = DB::table('edulevel2')->get();

        // dd($edulevel);
        // return view('edulevel/data', ['edulevel' => $edulevel]);
        // return view('edulevel/data', compact('edulevel'));
        return view('edulevel/data')->with('edulevel', $edulevel);
    }

    public function add()
    {
        return view('edulevel.add');
    }

    public function addProses(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'desc' => 'required',
        ]);

        DB::table('edulevel2')->insert(
            [
                'name' => $request->name, //match name in view
                'desc' => $request->desc
            ]
        );

        return redirect('edulevel')->with('toast_success', 'Data Berhasil Tersimpan!');
    }

    public function edit($id)
    {
        $edulevel = DB::table('edulevel2')->where('id', $id)->first();
        return view('edulevel/edit', compact('edulevel'));
    }

    public function editProses(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'desc' => 'required',
        ], [
            'name.required' => 'Nama jenjang tidak boleh kosong'
        ]);

        DB::table('edulevel2')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'desc' => $request->desc
            ]);

        return redirect('edulevel')->with('info', 'Data Berhasil diubah!');
    }

    public function delete($id)
    {
        DB::table('edulevel2')->where('id', $id)->delete();
        return redirect('edulevel')->with('warning', 'Data Berhasil dihapus!');
    }
}
