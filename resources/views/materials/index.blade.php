@extends('layouts.master')

@section('title')
    <title>Jumlah Bahan Baku</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Jumlah Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Bahan Baku</li>
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
                            <a href="{{ route('material.create') }}"
                               class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                        @endslot

                        @if (session('success'))
                            @alert(['type' => 'success'])
                            {!! session('success') !!}
                            @endalert
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Outlet</th>
                                    <th>Nama Bahan</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Last Update</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($raw_materials as $row)
                                    <tr>
                                        <td>{{ $row->outlet->outlet }}</td>
                                        <td>
                                            <strong>{{ ucfirst($row->raw_material) }}</strong>
                                        </td>
                                        <td>{{ $row->uom }}</td>
                                        <td>{{ $row->stock }}</td>
                                        <td>{{ $row->updated_at }}</td>
                                        <td>
                                            <form action="{{ route('material.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('material.edit', $row->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            {!! $raw_materials->links() !!}
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
