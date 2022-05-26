<?php

namespace App\Http\Controllers;

use App\Models\ObatAlkes;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Racikan;
use App\Models\Signa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.index', [
            'title' => 'History transaksi',
            'prescription' => Prescription::all()->sortByDesc('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create', [
            'title' => 'Tambah Transaksi',
            'obatalkes' => ObatAlkes::all(),
            'racikan' => Racikan::all()->sortByDesc('id'),
            'signa' => Signa::all()
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
        $listRacikan = $request->input('list-racikan');
        $listObat = $request->input('list-obat');
        $listQty = $request->input('list-qty');
        $listSigna = $request->input('signa');
        $prescription = Prescription::create(['nama_pasien' => $request->input('nama-pasien')]);

        $resepId = "RSP" . sprintf("%08d", $prescription->id);
        $prescription->resep_id = $resepId;
        $prescription->save();

        for ($i = 0; $i < sizeof($listRacikan); $i++) {
            $racikan = Racikan::find($listRacikan[$i]);
            $obat = ObatAlkes::find($listObat[$i]);
            if ($racikan != null) {
                $this->reduceStockRacikan($racikan);
            }

            if ($obat != null) {
                $obat->stok -= $listQty[$i];
                $obat->save();
            }

            DB::table('prescriptions_item')->insert([
                'prescription_id' => $prescription->id,
                'racikan_id' => $listRacikan[$i] == 0 ? NULL : $listRacikan[$i],
                'obatalkes_id' => $listObat[$i] == 0 ? NULL : $listObat[$i],
                'signa_id' => $listSigna[$i],
                'qty' => $listQty[$i]
            ]);
        }

        return redirect(url("/transaksi/$prescription->id/cetak"));;
    }

    private function reduceStockRacikan(Racikan $racikan)
    {
        foreach ($racikan->obatalkes as $oa) {
            $obat = ObatAlkes::find($oa->obatalkes_id);
            $obat->stok -= $oa->pivot->qty;
            $obat->save();
        }
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
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function cetak($id)
    {
        return view('transaksi.print', [
            'title' => 'Cetak Transaksi',
            'prescription' => Prescription::findOrFail($id),
            'prescription_items' => PrescriptionItem::where('prescription_id', '=', $id)->get()
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
