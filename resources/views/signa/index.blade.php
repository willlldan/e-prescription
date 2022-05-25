@extends('layout.main')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@endsection

@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Signa</h6>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="col-lg-12 table-responsive">
                <table id="table_id" class="display table table-bordered text-dark">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($signa as $s)
                        <tr class="text-center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$s->signa_kode}}</td>
                            <td>{{$s->signa_nama}}</td>
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