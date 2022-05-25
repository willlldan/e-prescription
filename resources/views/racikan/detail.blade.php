@extends('layout.main')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@endsection

@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Racikan</h6>
        </div>

        <div class="card-body">

            <div class="col-lg-12 table-responsive">
                <table id="table_id" class="display table table-bordered text-dark text-center">
                    <thead>
                        <tr class="table-info">
                            <th>Kode</th>
                            <th colspan="2">{{$racikan->racikan_kode}}</th>
                        </tr>
                        <tr class="table-info">
                            <th>Nama</th>
                            <th colspan="2">{{$racikan->racikan_nama}}</th>
                        </tr>
                        <tr>
                            <td colspan="3">Daftar Obat</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Qty</th>
                        </tr>
                        @foreach($racikan->obatalkes as $oa)
                        <tr>
                            <td>{{$oa->obatalkes_kode}}</td>
                            <td>{{$oa->obatalkes_nama}}</td>
                            <td>{{$oa->pivot->qty}}</td>
                        </tr>
                        @endforeach
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('custom-js')

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.11.5/dataRender/ellipsis.js"></script>

@endsection