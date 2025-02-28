<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyTypeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Policy Types';
        return view('admin.policy_type.index', compact('pageTitle'));
    }
}
