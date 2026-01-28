<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('solicitud', function () {
        return Inertia::render('Solicitud/Index');
    })->name('solicitud');

    Route::get('validacion', function () {
        return Inertia::render('Validacion/Index');
    })->name('validacion');

    Route::get('gestion', function () {
        return Inertia::render('Gestion/Index');
    })->name('gestion');

    Route::get('seguimiento', function () {
        return Inertia::render('Seguimiento/Index');
    })->name('seguimiento');

    Route::get('reportes', function () {
        return Inertia::render('Reportes/Index');
    })->name('reportes');

    Route::get('usuario', function () {
        return Inertia::render('Usuario/Index');
    })->name('usuario');
});

require __DIR__.'/settings.php';
