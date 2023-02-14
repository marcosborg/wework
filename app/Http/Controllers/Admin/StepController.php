<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStepRequest;
use App\Http\Requests\StoreStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Models\Funnel;
use App\Models\State;
use App\Models\Step;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StepController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('step_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Step::with(['funnel', 'state'])->select(sprintf('%s.*', (new Step())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'step_show';
                $editGate = 'step_edit';
                $deleteGate = 'step_delete';
                $crudRoutePart = 'steps';

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
            $table->addColumn('funnel_name', function ($row) {
                return $row->funnel ? $row->funnel->name : '';
            });

            $table->addColumn('state_name', function ($row) {
                return $row->state ? $row->state->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'funnel', 'state']);

            return $table->make(true);
        }

        return view('admin.steps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('step_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnels = Funnel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.steps.create', compact('funnels', 'states'));
    }

    public function store(StoreStepRequest $request)
    {
        $step = Step::create($request->all());

        return redirect()->route('admin.steps.index');
    }

    public function edit(Step $step)
    {
        abort_if(Gate::denies('step_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnels = Funnel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $step->load('funnel', 'state');

        return view('admin.steps.edit', compact('funnels', 'states', 'step'));
    }

    public function update(UpdateStepRequest $request, Step $step)
    {
        $step->update($request->all());

        return redirect()->route('admin.steps.index');
    }

    public function show(Step $step)
    {
        abort_if(Gate::denies('step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $step->load('funnel', 'state', 'stepItems');

        return view('admin.steps.show', compact('step'));
    }

    public function destroy(Step $step)
    {
        abort_if(Gate::denies('step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $step->delete();

        return back();
    }

    public function massDestroy(MassDestroyStepRequest $request)
    {
        Step::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
