<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Step;
use App\Notifications\NotifyStep;
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
        $item = Item::with([
            'client'
        ])
            ->where('id', $request->item_id)
            ->first();
        $item->step_id = $request->step_id;
        $item->save();

        $step = Step::find($item->step_id);

        if ($step->notify_client) {

            $template = $step->template_client;
            $data = [
                'client' => $item->client->first_name . ' ' . $item->client->last_name,
                'description' => $item->description
            ];

            $template = preg_replace_callback('/\{(.+?)\}/', function ($matches) use ($data) {
                return isset($data[$matches[1]]) ? $data[$matches[1]] : $matches[0];
            }, $template);

            $step->template_client = $template;

            $item->client->notify(new NotifyStep($step));
        }

        return $step;
    }

    public function item(Request $request)
    {
        $item = Item::where('id', $request->id)
            ->with([
                'client'
            ])->first();

        return view('partials.info')->with([
            'item' => $item,
        ]);
    }

}