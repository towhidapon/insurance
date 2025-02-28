<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Policies';
        $policies = Policy::all();
        return view('admin.policy.index', compact('pageTitle', 'policies'));
    }

    public function create()
    {
        $pageTitle = 'Create Policy';
        return view('admin.policy.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
    }
}
