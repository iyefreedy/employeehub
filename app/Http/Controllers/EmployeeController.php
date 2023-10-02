<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class EmployeeController extends Controller
{
    public function index(): InertiaResponse
    {

        if (!Gate::allows('view-any-employees')) {
            abort(403);
        }

        return Inertia::render('Employee/Index', [
            'employees' => Employee::all()
        ]);
    }
}
