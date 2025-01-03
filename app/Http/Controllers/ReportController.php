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

    public function monthlySalaryReport(Request $request): View|Factory|Application
    {
        $month = $request->input('month');
        $employees = Employee::with(['allowances' => function ($query) use ($month) {
            $query->wherePivot('month', $month);
        }])->get();

        $employeesReport = $employees->map(function ($employee) {
            $monthlySalaryData = [];

            for ($month = 1; $month <= 12; $month++) {
                $totalAllowance = $employee->allowances->where('pivot.month', $month)->sum('pivot.amount');
                $basicSalary = $employee->basic_salary;
                $totalSalary = $basicSalary + $totalAllowance;

                $monthlySalaryData[$month] = [
                    'month' => date('F', mktime(0, 0, 0, $month, 10)),
                    'total_salary' => $totalSalary,
                    'basic_salary' => $basicSalary,
                    'allowances' => $totalAllowance
                ];
            }

            // Calculate the total and average salary for the year
            $annualTotalSalary = array_sum(array_column($monthlySalaryData, 'total_salary'));
            $annualAverageSalary = $annualTotalSalary / 12;

            return [
                'name' => $employee->name,
                'monthly_salary_data' => $monthlySalaryData,
                'annual_total_salary' => $annualTotalSalary,
                'annual_average_salary' => $annualAverageSalary,
                'gender' => $employee->gender
            ];
        });

        // Rank the employees based on their annual average salary
        $employeesReport = $employeesReport->sortByDesc('annual_average_salary')->values()->all();

        // Assign ranks based on the annual average salary
        foreach ($employeesReport as $index => $employee) {
            $employee['rank_by_average'] = $index + 1;
        }

        // Calculate rank by gender (just an example, it can be customized)
        $rankByGender = $employeesReport->groupBy('gender')->map(function ($group) {
            return $group->count();
        });

        // Paginate the report data (optional, depending on your requirement)
        $paginatedReport = collect($employeesReport)->paginate(10);

        // Return the report to the view
        return view('reports.monthly_salary', compact('paginatedReport', 'rankByGender'));
    }

    public function accumulativeAllowanceReport()
    {

    }
}
