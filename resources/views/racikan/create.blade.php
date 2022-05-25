@extends('layout.main')


@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Item</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-8">
                        <form action="{{ url('/racikan') }}" method="post" id="form-racikan">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="Nama Racikan" name="racikan_nama" class="form-control form-control-user @error('racikan_nama') is-invalid @enderror" id="racikan_nama" value="{{old('racikan_nama')}}" / autofocus="on" required>
                                @error('racikan_nama')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div id="list-obat">
                                <div class="form-group row" id="form-add-obat">
                                    <div class="col-10">
                                        <select name="list_obat[]" id="produk" class="form-control form-select @error('obatalkes_id') is-invalid @enderror" required>
                                            <option value="">Pilih Obat</option>
                                            @foreach($obatalkes as $oa)
                                            <option value="{{$oa->obatalkes_id}}" {{ $oa->obatalkes_id == old('obatalkes_id')? 'selected' : ''}}">
                                                {{$oa->obatalkes_kode}} - {{$oa->obatalkes_nama}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" placeholder="qty" name="list_qty[]" class="form-control form-control-user @error('qty') is-invalid @enderror" id="qty" value="{{old('qty')}}" / autocomplete="off" required>
                                        @error('qty')
                                        <div class="ml-3 invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mr-2" id="btn-add-obat">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-danger" id="btn-remove-obat">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary brn-rounded" type="submit">Tambah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('custom-js')

<!-- Autonumeric -->
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

<script>
    $('#btn-add-obat').on('click', function() {
        $('#form-add-obat').clone(true).attr('id', '').appendTo('#list-obat')
    })

    $('#btn-remove-obat').on('click', function() {
        const children = $('#list-obat').children()
        if (children.length > 1) {
            children.last().remove()
        }
    })
</script>
@endsection