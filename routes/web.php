<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ResumeController::class, 'index'])->name('home');
Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
Route::get('/resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
Route::get('/resumes/{username}', [ResumeController::class, 'show'])->name('resumes.show');
Route::get('/resumes/{username}/edit', [ResumeController::class, 'edit'])->name('resumes.edit');
Route::put('/resumes/{resume}', [ResumeController::class, 'update'])->name('resumes.update');
Route::delete('/resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');
