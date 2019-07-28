@extends('layouts.master')

{{--@section('title')--}}
    {{--<title>Jumlah Bahan Baku</title>--}}
{{--@endsection--}}

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{--@card--}}
                        {{--@slot('title')--}}
                            {{--<a href="{{ route('material.create') }}"--}}
                               {{--class="btn btn-primary btn-sm">--}}
                                {{--<i class="fa fa-edit"></i> Tambah--}}
                            {{--</a>--}}
                        {{--@endslot--}}

                        {{--@if (session('success'))--}}
                            {{--@alert(['type' => 'success'])--}}
                            {{--{!! session('success') !!}--}}
                            {{--@endalert--}}
                        {{--@endif--}}

                        <form action="{{ route('order.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Mulai Tanggal</label>
                                        <input type="text" name="start_date"
                                               class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                               id="start_date"
                                               value="{{ request()->get('start_date') }}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sampai Tanggal</label>
                                        <input type="text" name="end_date"
                                               class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}"
                                               id="end_date"--}}
                                               value="{{ request()->get('end_date') }}">
                                    </div>

                                    {{--<div class="form-group">--}}
                                        {{--<label for="">Outlet</label>--}}
                                        {{--<select name="outlet_id" class="form-control">--}}
                                            {{--<option value="">Semua Outlet</option>--}}
                                            {{--@foreach ($outlets as $outlet)--}}
                                                {{--<option value="{{ $outlet->id }}"--}}
                                                        {{--{{ request()->get('outlet_id') == $outlet->id ? 'selected':'' }}>--}}
                                                    {{--{{ $outlet->outlet }}--}}
                                                {{--</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Cari</button>
                                    </div>
                                </div>

                            </div>
                        </form>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    {{--<th>Id</th>--}}
                                    <th>Outlet</th>
                                    <th>Kasir</th>
                                    <th>Harga Total</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($orders as $row)
                                    <tr>
                                        {{--<td>{{ $row->id }}</td>--}}
                                        <td>{{ $row->outlet->outlet }}</td>


                                        <td>{{ $row->employee->name}}</td>
                                        <td>Rp. {{ $row->total }}</td>
                                        <td>{{ $row->updated_at }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{--<div class="float-right">--}}
                            {{--{!! $orders->links() !!}--}}
                        {{--</div>--}}
                        @slot('footer')

                        @endslot
                        {{--@endcard--}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
