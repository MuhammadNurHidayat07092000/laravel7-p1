<?php

namespace App\Http\Controllers;

use App\Program;
use App\Edulevel;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programs = Program::onlyTrashed()->get(); //menampilkan yang soft delete saja
        // $programs = Program::withTrashed()->get(); //menampilkan keduanya->soft delete and non soft delete
        // $programs = Program::all();
        $programs = Program::with('edulevel')->paginate(5); // menampilkan data yang deleted_atnya null
        return view('program/index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edulevel = Edulevel::all();
        return view('program/create', compact('edulevel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:3',
            'edulevel_id' => 'required',
        ], [
            'name.required'        => 'Nama tidak boleh kosong',
            'edulevel_id.required' => 'Jenjang tidak boleh kosong'
        ]);
        // return $request;

        // Cara 1
        // $program = new Program;
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        // Cara 2 :mess assignment
        // Program::create([
        //     'name' => $request->name,
        //     'edulevel_id' => $request->edulevel_id,
        //     'student_price' => $request->student_price,
        //     'student_max' => $request->student_max,
        //     'info' => $request->info
        // ]);

        // Cara 3 : quick mess assignment > syarat : field tabel dan name inputan harus sama
        Program::create($request->all());

        // Cara 4 : gabungan
        // $program = new Program([
        //     'name' => $request->name,
        //     'edulevel_id' => $request->edulevel_id,
        //     'student_price' => $request->student_price,
        //     'student_max' => $request->student_max,
        //     'info' => $request->info
        // ]);
        // $program->student_price = $request->student_price;
        // $program->save();

        return redirect('programs')->with('success', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        // $program = Program::find($id); berbentuk objek
        // $program = Program::where('id', $id)->get();
        // $program = $program[0]; berbentuk array object
        $program->makeHidden(['edulevel_id']);
        return view('program/show', compact('program'));

        // return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $edulevel = Edulevel::all();
        return view('program.edit', compact('program', 'edulevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name'        => 'required|min:3',
            'edulevel_id' => 'required',
        ], [
            'name.required'        => 'Nama tidak boleh kosong',
            'edulevel_id.required' => 'Jenjang tidak boleh kosong'
        ]);
        // Cara 1
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        //Cara 2 : mass assignment
        Program::where('id', $program->id)
            ->update([
                'name' => $request->name,
                'edulevel_id' => $request->edulevel_id,
                'student_price' => $request->student_price,
                'student_max' => $request->student_max,
                'info' => $request->info
            ]);

        return redirect('programs')->with('info', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        // Cara 1
        $program->delete();

        // Cara 2
        // Program::destroy($program->id);

        // Cara 3
        // Program::where('id', $program->id)->delete();

        return redirect('programs')->with('warning', 'Program Berhasil Terhapus!');
    }

    public function trash()
    {
        $programs = Program::onlyTrashed()->get();
        return view('program/trash', compact('programs'));
    }

    public function restore($id = null)
    {
        if ($id != null) {
            $programs = Program::onlyTrashed()
                ->where('id', $id)
                ->restore();
        } else {
            $programs = Program::onlyTrashed()->restore();
        }

        return redirect('programs/trash')->with('success', 'Program Berhasil di Restore!');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            $programs = Program::onlyTrashed()
                ->where('id', $id)
                ->forceDelete();
        } else {
            $programs = Program::onlyTrashed()->forceDelete();
        }

        return redirect('programs/trash')->with('warning', 'Program Berhasil Terhapus Permanen!');
    }
}
