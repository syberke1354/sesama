<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\RecipientImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Public Routes
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/program', [App\Http\Controllers\ProgramController::class, 'index'])->name('program');
Route::get('/program/{id}', [App\Http\Controllers\ProgramController::class, 'show'])->name('program.show');

Route::get('/donasi', [App\Http\Controllers\DonationController::class, 'index'])->name('donasi');
Route::get('/donasi/{id}', [App\Http\Controllers\DonationController::class, 'show'])->name('donasi.show');

Route::post('/chatbot/message', [App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/recipients/print-all', [RecipientController::class, 'printAllQrCodes'])->name('recipients.printAll');
    Route::resource('recipients', RecipientController::class);
    Route::get('/recipients/{recipient}/qr-code', [RecipientController::class, 'generateQrCode'])->name('recipients.qr-code');
    Route::get('/recipients/{recipient}/qr-print', [RecipientController::class, 'printQrCode'])->name('recipients.qr-print');
    Route::get('/scan', [RecipientController::class, 'scanQr'])->name('recipients.scan');
    Route::post('/recipients/verify-qr', [RecipientController::class, 'verifyQr'])->name('recipients.verify-qr');
    Route::post('/recipients/{recipient}/distribute', [RecipientController::class, 'distribute'])->name('recipients.distribute');
    Route::get('/recipients/{recipient}/receipt', [RecipientController::class, 'generateReceipt'])->name('recipients.receipt');
    Route::get('/recipients/{recipient}/signature', [RecipientController::class, 'generateSignatureForm'])->name('recipients.signature');
    Route::get('/report', [RecipientController::class, 'generateReport'])->name('recipients.report');
    Route::get('/recipient/import', [RecipientImportController::class, 'form']);
    Route::post('/recipient/import', [RecipientImportController::class, 'import'])->name('recipients.import');
    Route::post('/verify-qr-registration', [RecipientController::class, 'verifyQrRegistration']);
    Route::post('/mark-registered', [RecipientController::class, 'markRegistered']);
    Route::get('/registration', function () {
        return view('registration');
    })->name('registration');

    Route::post('/registration/verify', [RegistrationController::class, 'verifyRegistrationQr'])->name('registration.verify');
    Route::post('/registration/confirm', [RegistrationController::class, 'confirmRegistration'])->name('registration.confirm');

    Route::get('/admin/programs', [App\Http\Controllers\ProgramController::class, 'adminIndex'])->name('admin.programs.index');
    Route::get('/admin/programs/create', [App\Http\Controllers\ProgramController::class, 'create'])->name('admin.programs.create');
    Route::post('/admin/programs', [App\Http\Controllers\ProgramController::class, 'store'])->name('admin.programs.store');
    Route::get('/admin/programs/{id}/edit', [App\Http\Controllers\ProgramController::class, 'edit'])->name('admin.programs.edit');
    Route::put('/admin/programs/{id}', [App\Http\Controllers\ProgramController::class, 'update'])->name('admin.programs.update');
    Route::delete('/admin/programs/{id}', [App\Http\Controllers\ProgramController::class, 'destroy'])->name('admin.programs.destroy');

    Route::get('/admin/donations', [App\Http\Controllers\DonationController::class, 'adminIndex'])->name('admin.donations.index');
    Route::get('/admin/donations/create', [App\Http\Controllers\DonationController::class, 'create'])->name('admin.donations.create');
    Route::post('/admin/donations', [App\Http\Controllers\DonationController::class, 'store'])->name('admin.donations.store');
    Route::get('/admin/donations/{id}/edit', [App\Http\Controllers\DonationController::class, 'edit'])->name('admin.donations.edit');
    Route::put('/admin/donations/{id}', [App\Http\Controllers\DonationController::class, 'update'])->name('admin.donations.update');
    Route::delete('/admin/donations/{id}', [App\Http\Controllers\DonationController::class, 'destroy'])->name('admin.donations.destroy');

    Route::get('/admin/chatbot', [App\Http\Controllers\ChatbotController::class, 'adminIndex'])->name('admin.chatbot.index');
    Route::get('/admin/chatbot/create', [App\Http\Controllers\ChatbotController::class, 'create'])->name('admin.chatbot.create');
    Route::post('/admin/chatbot', [App\Http\Controllers\ChatbotController::class, 'store'])->name('admin.chatbot.store');
    Route::get('/admin/chatbot/{id}/edit', [App\Http\Controllers\ChatbotController::class, 'edit'])->name('admin.chatbot.edit');
    Route::put('/admin/chatbot/{id}', [App\Http\Controllers\ChatbotController::class, 'update'])->name('admin.chatbot.update');
    Route::delete('/admin/chatbot/{id}', [App\Http\Controllers\ChatbotController::class, 'destroy'])->name('admin.chatbot.destroy');
});



Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('userdashboard');
    Route::get('/list', [UserController::class, 'list'])->name('list');

});
