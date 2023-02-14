<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInputRequest;
use App\Http\Requests\StoreInputRequest;
use App\Http\Requests\UpdateInputRequest;
use App\Models\Input;
use App\Models\Item;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InputController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('input_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Input::with(['item'])->select(sprintf('%s.*', (new Input())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'input_show';
                $editGate = 'input_edit';
                $deleteGate = 'input_delete';
                $crudRoutePart = 'inputs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('item_name', function ($row) {
                return $row->item ? $row->item->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'item']);

            return $table->make(true);
        }

        return view('admin.inputs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('input_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.inputs.create', compact('items'));
    }

    public function store(StoreInputRequest $request)
    {
        $input = Input::create($request->all());

        return redirect()->route('admin.inputs.index');
    }

    public function edit(Input $input)
    {
        abort_if(Gate::denies('input_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = Item::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $input->load('item');

        return view('admin.inputs.edit', compact('input', 'items'));
    }

    public function update(UpdateInputRequest $request, Input $input)
    {
        $input->update($request->all());

        return redirect()->route('admin.inputs.index');
    }

    public function show(Input $input)
    {
        abort_if(Gate::denies('input_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $input->load('item');

        return view('admin.inputs.show', compact('input'));
    }

    public function destroy(Input $input)
    {
        abort_if(Gate::denies('input_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $input->delete();

        return back();
    }

    public function massDestroy(MassDestroyInputRequest $request)
    {
        Input::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
