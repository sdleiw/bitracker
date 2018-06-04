<?php
/**
 * Created by lei
 */

Route::get('/portfolio', 'Lei\Bitracker\Http\Controllers\DashboardController@index')->name('portfolio.dashboard.index');

Route::get('/', function () {
    return redirect()->route('portfolio.dashboard.index');
});