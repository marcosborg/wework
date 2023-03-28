<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFunnelRequest;
use App\Http\Requests\StoreFunnelRequest;
use App\Http\Requests\UpdateFunnelRequest;
use App\Models\Category;
use App\Models\Funnel;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FunnelController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('funnel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Funnel::with(['category'])->select(sprintf('%s.*', (new Funnel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'funnel_show';
                $editGate      = 'funnel_edit';
                $deleteGate    = 'funnel_delete';
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
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('file_text', function ($row) {
                return $row->file_text ? $row->file_text : '';
            });
            $table->editColumn('file', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->file ? 'checked' : null) . '>';
            });
            $table->editColumn('message_text', function ($row) {
                return $row->message_text ? $row->message_text : '';
            });
            $table->editColumn('message', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->message ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'file', 'message']);

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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $funnel->id]);
        }

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

        $funnel->load('category', 'funnelSteps', 'funnelsCompanies');

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
        $funnels = Funnel::find(request('ids'));

        foreach ($funnels as $funnel) {
            $funnel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('funnel_create') && Gate::denies('funnel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Funnel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}