<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function allowanceReport(Request $request): View|Factory|Application
    {
        $month = $request->input('month');
        $employees = Employee::with(['allowances' => function ($query) use ($month) {
            $query->wherePivot('month', $month);
        }])->paginate(20);

        $employeesReport = $employees->map(function ($employee) {
            $totalAllowance = $employee->allowances->sum('pivot.amount');
            $avgAllowance = $employee->allowances->avg('pivot.amount');
            $rankByAverage = $avgAllowance > ($avgAllowance / 2) ? 'High' : 'Low';
            $rankByGender = $employee->gender;

            return [
                'name' => $employee->name,
                'food' => $employee->allowances->where('name', 'Food')->sum('pivot.amount'),
                'transport' => $employee->allowances->where('name', 'Transport')->sum('pivot.amount'),
                'communication' => $employee->allowances->where('name', 'Communication')->sum('pivot.amount'),
                'child_care' => $employee->allowances->where('name', 'Child Care')->sum('pivot.amount'),
                'school_fee' => $employee->allowances->where('name', 'School Fee')->sum('pivot.amount'),
                'total' => $totalAllowance,
                'average' => $avgAllowance,
                'rank_by_average' => $rankByAverage,
                'rank_by_gender' => $rankByGender
            ];
        });

        return view('reports.monthly_allowance', compact('employeesReport', 'employees'));
    }

    public function monthlySalaryReport(Request $request)
    {
    }

    public function accumulativeAllowanceReport()
    {

    }
}
