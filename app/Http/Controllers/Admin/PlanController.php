<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Policy Plans';

        $plans = Plan::with('category')->whereHas('category', function ($query)
        {
            $query->where('status', '1');
        })->get();
        $categories = Category::where('status', '1')->get();
        return view('admin.plan.index', compact('pageTitle', 'plans', 'categories'));
    }

    public function create()
    {
        $pageTitle = 'Create Plan';
        $categories = Category::where('status', '1')->get();
        return view('admin.plan.create', compact('pageTitle', 'categories'));
    }

    public function save(request $request, $id = 0)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:plans,name,' . $id,
            'price' => 'required|numeric|gt:0',
            'payment_duration' => 'required|numeric|gt:0',
            'coverage_amount' => 'required|numeric|gt:0',
            'validity' => 'required|string',
            'spouse_coverage' => 'boolean',
            'children_coverage' => 'boolean',
            'no_children' => 'integer|min:1',
        ]);

        if ($id)
        {
            $plan = Plan::find($id);
            $message = "Plan updated successfully";
        }
        else
        {
            $plan = new Plan();
            $message = "Plan added successfully";
        }
        $plan->category_id = $request->category_id;
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->payment_duration = $request->payment_duration;
        $plan->coverage_amount = $request->coverage_amount;
        $plan->validity = $request->validity;
        $plan->spouse_coverage = $request->spouse_coverage ?? 0;
        $plan->children_coverage = $request->children_coverage ?? 0;
        $plan->no_children = $request->no_children ?? 0;
        $plan->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function toggleStatus($id)
    {
        return Plan::changeStatus($id);
    }
}
