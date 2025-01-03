<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'basic_salary',
    ];

    public function allowances(): BelongsToMany
    {
        return $this->belongsToMany(Allowance::class, 'employee_allowances', 'employee_id', 'allowance_id')
            ->withPivot('month', 'amount');
    }

    public function monthlySalaries(): HasMany
    {
        return $this->hasMany(EmployeeMonthlySalary::class);
    }

}
