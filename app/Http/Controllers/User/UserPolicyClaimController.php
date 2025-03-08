<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\ClaimRequest;
use App\Models\InsuredPlan;
use Illuminate\Http\Request;

class UserPolicyClaimController extends Controller
{
    public function showPolicyHolderInfo()
    {
        $insuredPlans = InsuredPlan::where('user_id', auth()->user()->id)
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->get();
        $pageTitle = 'Policy Holder Information';

        return view('Template::user.claim_insurance.policy_holder_info', compact('insuredPlans', 'pageTitle'));
    }

    public function storePolicyHolderInfo(Request $request)
    {
        $validatedData = $request->validate([
            'plan_subscribe_id' => 'required|exists:insured_plans,id',
            'name'              => 'required|string|max:255',
            'dob'               => 'required|date',
            'gender'            => 'required|in:Male,Female',
            'identification'    => 'required|string|max:255',
            'phone'             => 'required|string|max:20',
            'email'             => 'required|email|max:255',
        ]);

        $claimRequest = ClaimRequest::firstOrNew([
            'plan_subscribe_id' => $validatedData['plan_subscribe_id'],
            'status'            => Status::CLAIM_PENDING,
        ]);

        $claimRequest->fill(array_merge($validatedData, [
            'description'    => '',
            'attachement'    => '',
            'approve_amount' => 0,
            'approve_date'   => null,
            'others_details' => json_encode([]),
        ]));
        $claimRequest->save();

        $notify[] = ['success', 'Policy holder information saved successfully.'];
        return redirect()->route('user.claim.accident')->withNotify($notify);

    }
}
