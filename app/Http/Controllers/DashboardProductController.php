<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function dashboard_product() {
        return view('pages.dashboard-product');
    }

    public function detail() {
        return view('pages.dashboard-product-detail');
    }

    public function create() {
        return view('pages.dashboard-product-create');
    }
}
