<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\BooksController;


route::get('/buku',[BooksController::class,'index']) -> name('buku');
route::get('/buku/create',[BooksController::class,'create'])->name('create');
route::post('/buku',[BooksController::class,'store'])->name('store');
route::delete('/buku/{id}',[BooksController::class,'destroy'])->name('destroy');
route::get('/buku/{id}/edit',[BooksController::class,'edit'])->name('edit');
route::put('/buku/{id}/update',[BooksController::class,'update'])->name('update');
route::get('/buku/search',[BooksController::class,'search'])->name('search');
