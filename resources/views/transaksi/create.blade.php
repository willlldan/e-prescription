@extends('layout.main')


@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Obat/Racikan</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-10">
                        <form method="post" id="form-racikan">
                            @csrf
                            <div class="form-group row" id="form-add-obat">
                                <div class="col-lg-2">
                                    <select id="type" class="form-control form-select">
                                        <option value="obat" selected>Obat</option>
                                        <option value="racikan">Racikan</option>
                                    </select>
                                </div>

                                <div class="col-8 show list-obat">
                                    <select name="list-selected" id="obat" class="form-control form-select" required>
                                        <option value="">Pilih Obat</option>
                                        @foreach($obatalkes as $oa)
                                        <option value="{{$oa->obatalkes_id}}" {{ $oa->obatalkes_id == old('obatalkes_id')? 'selected' : ''}}" class="{{$oa-> stok == 0? 'text-danger': ''}}" {{$oa-> stok == 0? 'disabled': ''}}>

                                            {{$oa->obatalkes_kode}} - {{$oa->obatalkes_nama}} || Qty: {{$oa->stok}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-10 d-none" id="list-racikan">
                                    <select name="list-selected" id="racikan" class="form-control form-select" required>
                                        <option value="">Pilih Racikan</option>
                                        @foreach($racikan as $r)
                                        <option value="{{$r->id}}">
                                            {{$r->racikan_kode}} - {{$r->racikan_nama}}
                                        </option>
                                        @endforeach
                                    </select>

                                    <div class="ml-3 text-danger d-none" id="racikan-error">
                                        <small>
                                            Qty dipilih melebihi stok yang ada.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-2 show list-obat">
                                    <input type="number" placeholder="qty" name="list_qty[]" class="form-control form-control-user" id="qty" autocomplete="off" required>

                                    <div class="ml-3 text-danger d-none" id="qty-error">
                                        <small class="d-none" id="qty-offset">
                                            Qty dipilih melebihi stok yang ada.
                                        </small>
                                        <small class="d-none" id="qty-empty">
                                            Qty tidak boleh kosong
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="signa" id="signa" class="form-control form-select" required>
                                    <option value="">Pilih Signa</option>
                                    @foreach($signa as $s)
                                    <option value="{{$s->signa_id}}">
                                        {{$s->signa_kode}} - {{$s->signa_nama}}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="ml-3 text-danger d-none" id="signa-error">
                                    <small>
                                        Signa tidak boleh kosong.
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary brn-rounded" type="button" id="btn-tambah-prescription">Tambah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Preview Prescription</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-10">
                        <form action="{{ url('/transaksi') }}" method="post" id="form-submit-prescription">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="Nama Pasien" name="nama-pasien" class="form-control form-control-user" id="nama-pasien" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary brn-rounded" type="submit">Submit Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <table id="table-preview" class="display table table-bordered text-dark">
                    <tr>
                        <th>No</th>
                        <th>Obat/Racikan</th>
                        <th>QTY</th>
                        <th>Signa</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @endsection


    @section('custom-js')

    <!-- Autonumeric -->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

    <script src="{{ url('assets/js/transaksi.js') }}"></script>
    @endsection