<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index($category_id = null)
    {

        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user()->with([
            'company.funnels.category'
        ])->first();

        $categories = collect();

        foreach ($user->company->funnels as $funnel) {
            $categories->add($funnel->category);
        }

        $categories = $categories->unique('id');

        return view('admin.projects.index')->with([
            'categories' => $categories,
            'category_id' => $category_id,
        ]);
    }

    public function ajax($category_id = null)
    {

        $user = auth()->user()->with([
            'company.funnels.category'
        ])->first();

        $categories = collect();

        foreach ($user->company->funnels as $funnel) {
            $categories->add($funnel->category);
        }

        $categories = $categories->unique('id');

        $category_id = $category_id ? $category_id : $categories[0]->id;

        $category = Category::where([
            'id' => $category_id,
        ])
            ->with([
                'funnels.steps.stepItems.client',
                'funnels.steps.stepItems.lastInput',
                'funnels.steps.state'
            ])
            ->whereHas('funnels.steps.stepItems', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->first();

        return view('partials.projects')->with([
            'category' => $category
        ]);
    }

    public function projectsUpdate(Request $request)
    {
        $item = Item::find($request->item_id);
        $item->step_id = $request->step_id;
        $item->save();

        return $item;
    }

}