@extends('layouts.master')

@section('title')
    <title>Jabatan</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Jabatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Jabatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('employees.set_role', $employee->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            @card
                            @slot('title')
                            @endslot

                            @if (session('success'))
                                @alert(['type' => 'success'])
                                {{ session('success') }}
                                @endalert
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>:</td>
                                        <td>
                                            @foreach ($roles as $row)
                                                <input type="radio" name="role"
                                                       {{ $employee->hasRole($row) ? 'checked':'' }}
                                                       value="{{ $row }}"> {{  $row }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm float-right">
                                        Set Role
                                    </button>
                                </div>
                            @endslot
                            @endcard
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection