<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\District;
use App\Models\Funnel;
use App\Models\Input;
use App\Models\Item;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'file' => 'required',
        ], [], [
                'first_name' => 'Nome',
                'last_name' => 'Sobrenome',
                'phone' => 'Contacto',
                'email' => 'Email',
                'file' => 'CV',
            ]);

        //CRIAR CLIENT
        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->save();

        //CRIAR ITEM
        $funnel = Funnel::where('id', $request->funnel_id)
            ->with('steps')
            ->first();
        $item = new Item;
        $item->name = $funnel->name;
        $item->step_id = $funnel->steps[0]->id;
        $item->client_id = $client->id;
        $item->save();

        //ENVIAR CV

        if ($request->input('file', false)) {
            $item->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        //CRIAR INPUT

        $district = District::find($request->district);

        $input = new Input;
        $input->name = $funnel->steps[0]->name;
        $input->description = 'Candidato concorre ao distrito ' . $district->name;
        $input->save();

        return redirect()->back()->with('success', 'Enviado com sucesso.');
    }
}