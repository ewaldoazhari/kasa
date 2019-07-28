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
                        <h1 class="m-0 text-dark">Data Perusahaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Perusahaan</li>
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

                        @if (session('success'))
                            @alert(['type' => 'success'])
                            {!! session('success') !!}
                            @endalert
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Kategori Bisnis</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($businesses as $row)
                                    <tr>
                                        <td>{{ $row->business_name }}</td>
                                        <td>{{ $row->business_category->category }}</td>
                                        <td>{{ $row->office_address }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <!-- <td>
                                            <form action="{{ route('outlet.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('outlet.edit', $row->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="float-right"> --}}
                            {{-- {!! $businesses->links() !!} --}}
                        {{-- </div> --}}
                        @slot('footer')

                        @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
