<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('EducationalLevels', 'EducationalLevels')
    ->name('EducationalLevels');

Route::view('contactUs', 'contactUs')
    ->name('contactUs');

Route::view('PictureAlbum', 'PictureAlbum')
    ->name('PictureAlbum');


Route::view('aboutUs', 'aboutUs')
    ->name('aboutUs');

Route::view('EducationalGroups', 'EducationalGroups')
    ->name('EducationalGroups');

Route::view('FacultyMembers', 'FacultyMembers')
    ->name('FacultyMembers');


Route::view('Rashidi', 'Rashidi')
    ->name('Rashidi');

Route::view('Rahimi', 'Rahimi')
    ->name('Rahimi');

Route::view('Teimouri', 'Teimouri')
    ->name('Teimouri');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
