@extends('layouts.master')

@section('title')
    <title>Edit Data Outlet</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('outlet.index') }}">Outlet</a></li>
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
                        <form action="{{ route('outlet.update', $outlet->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="">Nama Outlet</label>
                                <input type="text" name="outlet" required
                                       value="{{ $outlet->outlet }}"
                                       class="form-control {{ $errors->has('outlet') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('outlet') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Outlet</label>
                                <input type="text" name="address" required
                                       value="{{ $outlet->address }}"
                                       class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Kotat</label>
                                <input type="text" name="city" required
                                       value="{{ $outlet->city }}"
                                       class="form-control {{ $errors->has('city') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('city') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon Outlet</label>
                                <input type="text" name="phone_number" required
                                       value="{{ $outlet->phone_number }}"
                                       class="form-control {{ $errors->has('phone_number') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Catatan Bon</label>
                                <textarea name="note" id="note"
                                          cols="5" rows="5"
                                          class="form-control {{ $errors->has('note') ? 'is-invalid':'' }}">{{ $outlet->note }}</textarea>
                                <p class="text-danger">{{ $errors->first('note') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="photo" class="form-control">
                                <p class="text-danger">{{ $errors->first('photo') }}</p>
                                @if (!empty($outlet->photo))
                                    <hr>
                                    <img src="{{ asset('uploads/outlet/' . $outlet->photo) }}"
                                         alt="{{ $outlet->outlet }}"
                                         width="150px" height="150px">
                                @endif
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
