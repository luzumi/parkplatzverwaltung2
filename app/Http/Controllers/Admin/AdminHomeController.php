<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminHomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $viewData = [];
        $viewData['title'] = 'Adminpage - Home -Parkplatzverwaltung';

        return view('admin.home.index')->with("viewData", $viewData);
    }
}
