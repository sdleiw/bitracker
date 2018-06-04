<?php

namespace Lei\Bitracker\Http\Controllers;

use Lei\Bitracker\Http\ViewObjects\Dashboard;

/**
 * Class DashboardController
 * @package Lei\Bitracker\Http\Controllers
 */
class DashboardController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboard = app(Dashboard::class)->getDashboard();
        $accounts = $dashboard->exchange->exchanges;
        $portfolio = $dashboard->portfolio;

        return view('bitracker::dashboard.index', compact('accounts', 'portfolio'));
    }
}
