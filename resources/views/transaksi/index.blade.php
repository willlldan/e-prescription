@extends('layout.main')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@endsection

@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Racikan</h6>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="d-flex flex-row-reverse bd-highlight mb-3">
                <a class="btn btn-primary btn-rounded" href="{{ url('/racikan/create') }}"><i class="fa-solid fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-lg-12 table-responsive">
                <table id="table_id" class="display table table-bordered text-dark">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Id Resep</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescription as $p)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$p->resep_id}}</td>
                            <td>{{$p->nama_pasien}}</td>
                            <td>{{$p->created_at}}</td>
                            <td>
                                <a href="{{ url('/transaksi/' . $p->id) .'/cetak'}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Cetak Resep">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
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

<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            columnDefs: [{
                width: '5%',
                targets: 0
            }],
        });
    });
</script>

@endsection