<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allowance extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship with Employee
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_allowances', 'allowance_id', 'employee_id')
            ->withPivot('month', 'amount');
    }
}
