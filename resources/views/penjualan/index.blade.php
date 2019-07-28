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

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Outlet</th>
                                    <th>Kasir</th>
                                    <th>Harga Total</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($order_details as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->orders->no_struk}}</td>


                                        <td>{{ $row->products->name}}</td>
                                        <td>{{ $row0->qty}}</td>
                                        <td>{{ $row0->price}}</td>
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
