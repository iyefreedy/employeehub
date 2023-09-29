<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class EmployeeController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Employee/Index', [
            'employees' => Employee::all()
        ]);
    }
}
