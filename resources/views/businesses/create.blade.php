@extends('layouts.master')

@section('title')
    <title>Perusahaan</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Atur data perusahaan</h1>
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
                        <form action="{{ route('bisnis.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="text" name="business_name" required
                                       class="form-control {{ $errors->has('business_name') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('business_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Bisnis</label>
                                <select name="business_category_id" id="business_category_id"
                                        required class="form-control {{ $errors->has('business_name') ? 'is-invalid':'' }}">
                                    <option value="">Pilih</option>
                                    @foreach ($business_categories as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->category) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('business_category_id') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="description" id="description"
                                          cols="5" rows="5"
                                          class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pusat</label>
                                <input type="text" name="office_address" required
                                       class="form-control {{ $errors->has('office_address') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('office_address') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Kota</label>
                                <input type="text" name="city" required
                                       class="form-control {{ $errors->has('city') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('city') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="text" name="phone" required
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
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