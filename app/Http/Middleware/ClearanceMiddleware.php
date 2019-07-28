<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('admin')) //If user has this //permission
        {
            return $next($request);
        }

        if (Auth::user()->hasPermissionTo('owner')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('home'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard'))
            {
                abort('401');
            }
            else {
                return $next($request);
            }
        }

        if ($request->is('products/create')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Manajemen Produk')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('outlets/create')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Manajemen Outlet')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('orders/index')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Laoran Transaksi')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('sales/index')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Laporan Penjualan')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('employees/create')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Manajemen Kasir')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            }
            else
            {
                return $next($request);
            }
        }

        return $next($request);
    }
}