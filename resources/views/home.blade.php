@extends('layouts.master')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{--main content--}}
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                        @card
                        @slot('title')
                            Filter Laporan
                        @endslot

                        <form action="{{ route('home') }}" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Mulai Tanggal</label>
                                        <input type="text" name="start_date"
                                               class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                               id="start_date"
                                               value="{{ request()->get('start_date') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sampai Tanggal</label>
                                        <input type="text" name="end_date"
                                               class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}"
                                               id="end_date"
                                               value="{{ request()->get('end_date') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Outlet</label>
                                        <select name="outlet_id" class="form-control" title="Cari Berdasarkan Outlet">
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
                </div>
                <div class="col-md-12">
                    @card
                    @slot('title')
                        Laporan Penjualan
                    @endslot
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Rp {{ number_format($total) }}</h3>
                                    <p>Total Penjualan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
    {{--                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Rp {{ number_format($hpp) }}</h3>
                                    <p>Total Hpp</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
    {{--                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Rp {{ number_format($profit) }}</h3>
                                    <p>Total Keuntungan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
    {{--                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $transaction }}</h3>

                                    <p>Total Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
    {{--                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="chartOrder"></div>
                        </div>
                    </div>


                    
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark">Produk Terjual</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table  table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($order_details as $row)
                                    <tr>
                                        
                                        <td>{{ $row->product->name}}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>{{ $row->price }}</td>
                                        

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                

                    @slot('footer')

                    @endslot
                    @endcard
                </div>
                
                
                
                
            </div>
        </section>
    </div>

@endsection

@section('js')
    <!-- LOAD FILE dashboard.js -->
    {{--<script src="{{ asset('js/dashboard.js') }}"></script>--}}
    {{--<script>--}}
        {{--$('#start_date').datepicker({--}}
            {{--autoclose: true,--}}
            {{--format: 'yyyy-mm-dd'--}}
        {{--});--}}

        {{--$('#end_date').datepicker({--}}
            {{--autoclose: true,--}}
            {{--format: 'yyyy-mm-dd'--}}
        {{--});--}}
    {{--</script>--}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        $.getJSON('https://www.highcharts.com/samples/data/aapl-c.json', function (data) {

            // Create the chart
            Highcharts.stockChart('chartOrder', {


                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'AAPL Stock Price'
                },

                navigator: {
                    enabled: false
                },

                series: [{
                    name: 'AAPL Stock Price',
                    data: data,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });
    </script>
@endsection




