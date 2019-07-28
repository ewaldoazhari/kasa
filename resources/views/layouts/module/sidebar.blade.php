<aside class="main-sidebar sidebar-light-primary elevation-4">
    {{--brand logo--}}
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('img/kasalo.png')}}" alt="POS" class="">
    </a>


    {{--sidebar--}}
    {{--<a href="#" class="brand-logo"><h1><img src="{{ asset('img/kasalogo.png') }}" alt="POS"></h1></a>--}}
    <div class="sidebar">
        {{--sidebar user panel (optional)--}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/Kasa.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



                    <li class="nav-item has-treeview">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                                <i class="right fa fa-dashboard"></i>
                            </p>
                        </a>
                    </li>





{{--------BISNIS-------------------------------------------------------------------------------------}}

                @if (auth()->user()->can('manajemen bisnis'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-building-o"></i>
                            <p>
                                Manajemen Bisnis
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bisnis.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Perusahaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('outlet.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Outlet</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


{{--------KASIR--------------------------------------------------------------------------------------------}}
                @if (auth()->user()->can('manajemen kasir'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Manajemen Kasir
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employees.roles_permission') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Akses</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employees.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Kasir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

{{---USER--------------------------------------------------------------------------------------}}



                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Manajemen User
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.roles_permission') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Akses</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>




                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('order.transaksi') }}" class="nav-link">--}}
                        {{--<i class="nav-icon fa fa-shopping-cart"></i>--}}
                        {{--<p>--}}
                            {{--Order--}}
                        {{--</p>--}}
                    {{--</a>--}}
                {{--</li>--}}


{{----------PRODUK--------------------------------------------------------------------------------------------}}

                @if (auth()->user()->can('manajemen produk'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>
                                Manajemen Produk
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kategori.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('produk.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

{{--------BAHAN BAKU---------------------------------------------------------------------------------------------}}
                @if (auth()->user()->can('bahan baku'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                Bahan baku
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('material.create') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Tambah Bahan Baku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('resep.create') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Tambah Resep</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('material.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Jumlah Bahan Baku</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


{{---laporan--------------------------------------------------------------------------------------------------}}
                @if (auth()->user()->can('laporan'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-bar-chart"></i>
                            <p>
                                Laporan
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Transaksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penjualan.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Penjualan</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

{{-------------------------------------------------------------------------------------------------------}}
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="{{ route('logout') }} "
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
