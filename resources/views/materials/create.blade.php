@extends('layouts.master')

@section('title')
    <title>Tambah Bahan Baku</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('material.index') }}">Bahan Baku</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                        @slot('title')

                        @endslot

                        @if (session('error'))
                            @alert(['type' => 'danger'])
                            {!! session('error') !!}
                            @endalert
                        @endif
                        <form action="{{ route('material.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Outlet</label>
                                <select name="outlet_id" id="outlet_id"
                                        required class="form-control {{ $errors->has('raw_material') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($outlets as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->outlet) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('outlet_id') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Bahan</label>
                                <input type="text" name="raw_material" required
                                       class="form-control {{ $errors->has('raw_material') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('raw_material') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input type="text" name="uom" required
                                       class="form-control {{ $errors->has('uom') ? 'is-invalid':'' }}"
                                       placeholder="{{ __('gr, ml, cup') }}">
                                <p class="text-danger">{{ $errors->first('uom') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="number" name="stock" required
                                       class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('stock') }}</p>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Simpan
                                </button>
                            </div>
                        </form>
                        @slot('footer')

                        @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
