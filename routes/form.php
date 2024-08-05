<?php

use Illuminate\Support\Facades\Route;
use tatobuilder\FormBuilder\Http\Controllers\FormBuilderController;

Route::get('forms', [FormsController::class, 'index'] )->name('forms.index');
        Route::get('forms/create', [FormsController::class, 'create'])->name('forms.create');
        Route::post('forms/store', [FormsController::class, 'store'])->name('forms.store');
        Route::get('forms/edit/{form}', [FormsController::class, 'edit'])->name('forms.edit');
        Route::put('forms/update/{form}', [FormsController::class, 'update'])->name('forms.update');
        Route::delete('forms/destroy/{form}', [FormsController::class, 'destroy'])->name('forms.destroy');
        Route::post('forms/arrange', [FormsController::class, 'arrange']);
      