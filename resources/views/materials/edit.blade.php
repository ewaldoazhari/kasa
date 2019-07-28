@extends('layouts.master')

@section('title')
    <title>Edit Bahan Baku</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('material.index') }}">Bahan Baku</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                        <form action="{{ route('material.update', $raw_material->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="">Outlet</label>
                                <select name="outlet_id" id="outlet_id"
                                        required class="form-control {{ $errors->has('raw_material') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($outlets as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == $raw_material->outlet_id ? 'selected':'' }}>
                                            {{ ucfirst($row->outlet) }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('outlet_id') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Bahan</label>
                                <input type="text" name="raw_material" required
                                       value="{{ $raw_material->raw_material }}"
                                       class="form-control {{ $errors->has('raw_material') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('raw_material') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <input type="text" name="uom" required
                                       value="{{ $raw_material->uom }}"
                                       class="form-control {{ $errors->has('uom') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('uom') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="number" name="stock" required
                                       value="{{ $raw_material->stock }}"
                                       class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('stock') }}</p>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-info btn-sm">
                                    <i class="fa fa-refresh"></i> Update
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
