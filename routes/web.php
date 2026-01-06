<?php
use App\Http\Middleware\CheckAdmin; // 引入 CheckAdmin
use App\Http\Controllers\AdminMealController;
use App\Http\Controllers\AdminHomeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', CheckAdmin::class]) // 在這裡套用 CheckAdmin::class
    ->group(function () {

    Route::get('/', [AdminHomeController::class, 'index'])->name("home.index");

    //餐點管理
    Route::prefix('meals')->name('meals.')->group(function () {
        Route::get('/', [AdminMealController::class, 'index'])->name('index');          // 顯示: /admin/meals
        Route::get('/create', [AdminMealController::class, 'create'])->name('create');  // 新增: /admin/meals/create
        Route::post('/', [AdminMealController::class, 'store'])->name('store');         // 儲存: /admin/meals
        Route::get('/{meal}/edit', [AdminMealController::class, 'edit'])->name('edit'); // 編輯: /admin/meals/{id}/edit
        Route::put('/{meal}', [AdminMealController::class, 'update'])->name('update');  // 更新: /admin/meals/{id}
        Route::delete('/{meal}', [AdminMealController::class, 'destroy'])->name('destroy'); // 刪除: /admin/meals/{id}
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
