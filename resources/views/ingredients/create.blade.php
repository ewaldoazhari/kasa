@extends('layouts.master')

@section('title')
    <title>Tambah Resep</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Resep</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        <form action="{{ route('resep.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Outlet</label>
                                <select name="outlet_id" id="outlet_id"
                                        required class="form-control {{ $errors->has('stock_used') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($outlets as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->outlet) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('outlet_id') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="">Produk</label>
                                <select name="product_id" id="product_id"
                                        required class="form-control {{ $errors->has('outlet_id') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($products as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('product_id') }}</p>
                            </div>

                            <div class="col-md-12" style="display:flex">
                                <div class="form-group" style="width: 50%; margin-right: 100px;">
                                    <label for="">Bahan Baku</label>
                                    <select name="raw_material_id" id="raw_material_id"
                                            required class="form-control {{ $errors->has('product_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($raw_materials as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->raw_material) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('raw_material_id') }}</p>

                                </div>
                                <div class="form-group" style="width:50%;">
                                    <label for="">Jumlah yang Digunakan</label>
                                    <input type="number" name="stock_used" required
                                           class="form-control {{ $errors->has('stock_used') ? 'is-invalid':'' }}" placeholder="{{'contoh: 10'}}">
                                    <p class="text-danger">{{ $errors->first('stock_used') }}</p>
                                </div>
                            </div>


                            <div class=""></div>

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
