@extends('layout.main')


@section('container')

<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Item</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-8">
                        <form action="{{ url('/items/'. $item->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="kode" name="kode" class="form-control form-control-user @error('kode') is-invalid @enderror" id="kode" value="{{old('kode', $item->kode)}}" autofocus>
                                @error('kode')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="description" name="description" class="form-control form-control-user @error('description') is-invalid @enderror" id="description" value="{{old('description', $item->description)}}" />
                                @error('description')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="limit" name="limit" class="form-control form-control-user @error('limit') is-invalid @enderror" id="limit" value="{{old('limit', $item->limit)}}" />
                                @error('limit')
                                <div class="ml-3 invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary brn-rounded" type="submit">Update Data</button>
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