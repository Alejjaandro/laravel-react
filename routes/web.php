<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

// $role = Role::create(['name' => 'admin']);
// $role = Role::create(['name' => 'user']);

Route::get('/', function () {
    return view('welcome');
});
