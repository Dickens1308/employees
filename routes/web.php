<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::controller(ReportController::class)->prefix('reports')->group(function () {
    Route::get('monthly-allowance', 'allowanceReport')->name('reports.monthlyAllowance');
    Route::get('monthly-salary', 'monthlySalaryReport')->name('reports.monthlySalary');
    Route::get('yearly-accumulative-allowance', 'accumulativeAllowanceReport')->name('reports.yearlyAccumulativeAllowance');
});
