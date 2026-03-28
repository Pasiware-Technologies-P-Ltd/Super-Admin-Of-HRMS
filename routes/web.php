<?php

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('dashboard');
    Route::get('/companies', [SuperAdminController::class, 'companiesList'])->name('companies.list');
    Route::post('/company/register', [SuperAdminController::class, 'storeCompany'])->name('company.register');
    Route::post('/company/update/{id}', [SuperAdminController::class, 'updateCompany'])->name('company.update');
    
    Route::get('/plans', [SuperAdminController::class, 'plansList'])->name('plans.list');
    Route::post('/plans/store', [SuperAdminController::class, 'storePlan'])->name('plan.store');
    Route::post('/plans/update/{id}', [SuperAdminController::class, 'updatePlan'])->name('plan.update');

    Route::post('/plan/subscribe', [SuperAdminController::class, 'storeSubscription'])->name('plan.subscribe');
    Route::get('/subscriptions', [SuperAdminController::class, 'subscriptionsList'])->name('subscriptions.list');
    Route::post('/subscription/update-status/{id}', [SuperAdminController::class, 'updateSubscriptionStatus'])->name('subscription.update-status');
    Route::get('/upgrades', [SuperAdminController::class, 'upgradesList'])->name('upgrades.list');
    Route::post('/plan/upgrade', [SuperAdminController::class, 'upgradePlan'])->name('plan.upgrade');
    
    Route::get('/billing/invoices', [SuperAdminController::class, 'invoicesList'])->name('invoices.list');
    Route::get('/invoice/download/{id}', [SuperAdminController::class, 'downloadInvoice'])->name('invoice.download');
    
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');
});
