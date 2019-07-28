@extends('layouts.master')

@section('title')
    <title>Laporan Penjualan</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Laporan Penjualan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Penjualan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                        @slot('title')
                            Filter Penjualan
                        @endslot

                        <form action="{{ route('penjualan.index') }}" method="get">
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

                                    <div class="form-group">
                                        <label for="">Outlet</label>
                                        <select name="outlet_id" class="form-control">
                                            <option value="">Semua Outlet</option>
                                            @foreach ($outlets as $outlet)
                                                <option value="{{ $outlet->id }}"
                                                        {{ request()->get('outlet_id') == $outlet->id ? 'selected':'' }}>
                                                    {{ $outlet->outlet }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Cari</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                        @slot('footer')

                        @endslot
                        @endcard
                    </div>
                    <div class="col-md-12">
                        @card
                        @slot('title')
                            Data Penjualan
                        @endslot

                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>Rp {{ number_format($total) }}</h3>
                                        <p>Total Penjualan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $sold }}</h3>
                                        <p>Item Terjual</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $transaction}}</h3>
                                        <p>Total Transaksi</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Outlet</th>
                                    <th>Product</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($order_details as $row)
                                    <tr>
                                        <td>{{ $row->outlet->outlet}}</td>
                                        <td>{{ $row->product->name}}</td>
                                        <td>{{ $row->price}}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ $row->updated_at->format('d-m-Y H:i:s') }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @slot('footer')

                        @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('#start_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#end_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
