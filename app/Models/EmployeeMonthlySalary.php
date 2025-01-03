<?php

namespace App\Models;

use Database\Factories\EmployeeMonthlySalaryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeMonthlySalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'month',
        'total_salary'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
