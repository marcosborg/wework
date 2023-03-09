<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\District;
use App\Models\Funnel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        //VERIFICA SE FUNIL PODE SER UTILIZADO PELA EMPRESA

        $company = Company::where([
            'id' => $request->company_id
        ])->whereHas('funnels', function ($query) use ($request) {
            $query->where('id', $request->funnel_id);
        })
            ->first();

        abort_if(!$company, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnel = Funnel::where([
            'id' => $request->funnel_id,
        ])
            ->with('firstStep')
            ->first();

        $districts = District::all()->pluck('name', 'id');

        return view('products')->with([
            'funnel' => $funnel,
            'company' => $company,
            'districts' => $districts,
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            
        ], [], [

        ]);
        return $request;
    }
}