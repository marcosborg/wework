<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Funnel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnels = Funnel::all();
        $companies = Company::all();

        return view('admin.forms.index')->with([
            'funnels' => $funnels,
            'companies' => $companies,
        ]);
    }

}