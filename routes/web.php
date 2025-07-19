<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\User;
// use Hash;
Route::get('/', function () {
    if (User::count() === 0) {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@nba-ye.online';
        $user->password = Hash::make('Admin_*123sss@@321!@');
        $user->save();
    }
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('sms', App\Livewire\Sms::class)->name('sms');
    Route::get('side-manage', App\Livewire\SideManage::class)->name('side-manage');
});

require __DIR__.'/auth.php';
