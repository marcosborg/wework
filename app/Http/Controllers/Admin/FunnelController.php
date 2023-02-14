<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFunnelRequest;
use App\Http\Requests\StoreFunnelRequest;
use App\Http\Requests\UpdateFunnelRequest;
use App\Models\Category;
use App\Models\Funnel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FunnelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('funnel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Funnel::with(['category'])->select(sprintf('%s.*', (new Funnel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'funnel_show';
                $editGate = 'funnel_edit';
                $deleteGate = 'funnel_delete';
                $crudRoutePart = 'funnels';

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
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category']);

            return $table->make(true);
        }

        return view('admin.funnels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('funnel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.funnels.create', compact('categories'));
    }

    public function store(StoreFunnelRequest $request)
    {
        $funnel = Funnel::create($request->all());

        return redirect()->route('admin.funnels.index');
    }

    public function edit(Funnel $funnel)
    {
        abort_if(Gate::denies('funnel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $funnel->load('category');

        return view('admin.funnels.edit', compact('categories', 'funnel'));
    }

    public function update(UpdateFunnelRequest $request, Funnel $funnel)
    {
        $funnel->update($request->all());

        return redirect()->route('admin.funnels.index');
    }

    public function show(Funnel $funnel)
    {
        abort_if(Gate::denies('funnel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnel->load('category');

        return view('admin.funnels.show', compact('funnel'));
    }

    public function destroy(Funnel $funnel)
    {
        abort_if(Gate::denies('funnel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funnel->delete();

        return back();
    }

    public function massDestroy(MassDestroyFunnelRequest $request)
    {
        Funnel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
