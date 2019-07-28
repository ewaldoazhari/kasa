@extends('layouts.master')

@section('title')
    <title>Tambah Data Outlet</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Outlet</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('outlet.index') }}">Outlet</a></li>
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
                        <form action="{{ route('outlet.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <select name="business_id" id="business_id"
                                        required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($businesses as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->business_name) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('business_id') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Outlet</label>
                                <input type="text" name="outlet" required
                                       class="form-control {{ $errors->has('outlet') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('outlet') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Outlet</label>
                                <input type="text" name="address" required
                                       class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Kota</label>
                                <input type="text" name="city" required
                                       class="form-control {{ $errors->has('city') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('city') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon Outlet</label>
                                <input type="text" name="phone_number" required
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Catatan Bon</label>
                                <textarea name="note" id="note"
                                          cols="5" rows="5"
                                          class="form-control {{ $errors->has('note') ? 'is-invalid':'' }}"></textarea>
                                <p class="text-danger">{{ $errors->first('note') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="photo" class="form-control">
                                <p class="text-danger">{{ $errors->first('photo') }}</p>
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