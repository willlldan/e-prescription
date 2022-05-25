<?php

namespace App\Http\Controllers;

use App\Models\ObatAlkes;
use App\Models\Racikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RacikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $racikan = Racikan::find(1);

        // dump($racikan->obatalkes);

        // foreach ($racikan->obatalkes as $oa) {
        //     dump($oa->pivot->qty);
        // }

        // die;

        return view('racikan.index', [
            'title' => 'Racikan',
            'racikan' => Racikan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('racikan.create', [
            'title' => 'Tambah Racikan',
            'obatalkes' => ObatAlkes::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listObat = $request->input('list_obat');
        $listQty =  $request->input('list_qty');

        $racikan = Racikan::create([
            'racikan_nama' => $request->input('racikan_nama')
        ]);

        $racikanKode = "RCK" . sprintf("%08d", $racikan->id);
        $racikan->racikan_kode = $racikanKode;
        $racikan->save();

        for ($i = 0; $i < sizeof($listObat); $i++) {
            DB::table('racikan_obatalkes')->insert([
                'racikan_id' => $racikan->id,
                'obatalkes_id' => $listObat[$i],
                'qty' => $listQty[$i]
            ]);
        }

        return redirect(url('/racikan'))->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('racikan.detail', [
            'title' => 'Detail Racikan',
            'racikan' => Racikan::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
