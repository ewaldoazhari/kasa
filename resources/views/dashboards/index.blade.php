@extends('layouts.master')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! $chart->container() !!}
        </div>
    </div>
@endsection