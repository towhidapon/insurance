<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\Form;
use Illuminate\Http\Request;

class PolicyFormController extends Controller
{

    public function customForm($act)
    {
        $pageTitle = '' . ucfirst($act) . ' Information Form';
        $form      = Form::where('act', $act)->first();
        return view('admin.policy_form.form', compact('pageTitle', 'form'));
    }

    public function updateCustomForm(Request $request, $act)
    {
        $formProcessor       = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', $act)->first();
        $formProcessor->generate($act, $exist, 'act');

        $notify[] = ['success', ucfirst($act) . ' form updated successfully'];
        return back()->withNotify($notify);
    }
}
