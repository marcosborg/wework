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
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function submit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], 422);
        }

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
        $item->description = $request->description;
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
        $input->item_id = $item->id;
        $input->save();

        return [];
    }
}