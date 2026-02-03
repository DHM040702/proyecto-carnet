<?php
use App\Http\Controllers\AdministradoresController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('admin/login' , [AdministradoresController::class , 'login']);