<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Policy Plans';
        $plans     = Plan::with('category','features')->whereHas('category', function ($query) {
            $query->active();
        })->orderBy('id', 'desc')->paginate(getPaginate());

        dd($plans);
        $categories = Category::active()->get();
        $features   = Feature::all();
        return view('admin.plan.index', compact('pageTitle', 'plans', 'categories', 'features'));
    }

    public function save(request $request, $id = 0)
    {
      
        
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255|unique:plans,name,' . $id,
            'price'             => 'required|numeric|gt:0',
            'payment_duration'  => 'required|numeric|gt:0',
            'coverage_amount'   => 'required|numeric|gt:0',
            'validity'          => 'required|string',
            'spouse_coverage'   => 'boolean',
            'children_coverage' => 'boolean',
            'no_children'       => 'integer|min:1',
        ]);

        if ($id) {
            $plan    = Plan::find($id);
            $message = "Plan updated successfully";
        } else {
            $plan    = new Plan();
            $message = "Plan added successfully";
        }


        if($request->has('feature_id')) {
            $features = Feature::whereIn('id', $request->feature_id)->get();    


        }
        
        $plan->category_id       = $request->category_id;
        $plan->name              = $request->name;
        $plan->price             = $request->price;
        $plan->payment_duration  = $request->payment_duration;
        $plan->coverage_amount   = $request->coverage_amount;
        $plan->validity          = $request->validity;
        $plan->spouse_coverage   = $request->spouse_coverage ?? 0;
        $plan->children_coverage = $request->children_coverage ?? 0;
        $plan->no_children       = $request->no_children ?? 0;
        $plan->save();
        
        $plan->features()->sync($features);

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function toggleStatus($id)
    {
        return Plan::changeStatus($id);
    }
}