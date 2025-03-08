<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InsuredPlan;
use App\Models\Plan;
use App\Models\PolicyHolder;
use Illuminate\Http\Request;

class UserPlanController extends Controller
{
    public function showInsuranceInfo()
    {
        $pageTitle   = 'Insurance Plans';
        $plans       = Plan::Active();
        $categories  = Category::Active();
        $maxChildren = $plans->max('no_children');
        $maxCoverage = $plans->max('coverage_amount');

        return view('Template::user.plan_information.insurance', compact('plans', 'categories', 'pageTitle', 'maxChildren', 'maxCoverage'));
    }

    public function storeInsuranceInfo(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'member_type'     => 'required|in:Single,Couple,Family',
            'coverage_amount' => 'required|numeric|gt:0',
        ]);

        $plan = Plan::where('category_id', $request->category_id)
            ->where('status', Status::ENABLE)
            ->where(function ($query) use ($request) {
                if ($request->coverage_amount !== "all") {
                    $query->where('coverage_amount', '<=', $request->coverage_amount);
                }
            })
            ->orderByDesc('coverage_amount')
            ->first();

        if (! $plan) {
            $notify[] = ['error', 'No plans found matching your criteria.'];
            return redirect()->back()->withNotify($notify);
        }

        $insuredPlan                    = new InsuredPlan();
        $insuredPlan->user_id           = auth()->id;
        $insuredPlan->payment_status    = Status::PAYMENT_INITIATE;
        $insuredPlan->category_id       = $request->category_id;
        $insuredPlan->member_type       = $request->member_type;
        $insuredPlan->coverage          = $request->coverage_amount === "all" ? $plan->coverage_amount : $request->coverage_amount;
        $insuredPlan->plan_id           = $plan->id;
        $insuredPlan->price             = $plan->price;
        $insuredPlan->renewal_date      = now()->addMonths($plan->validity)->format('Y-m-d');
        $insuredPlan->validity          = $plan->validity;
        $insuredPlan->spouse_coverage   = $plan->spouse_coverage;
        $insuredPlan->children_coverage = $plan->children_coverage;
        $insuredPlan->no_children       = $plan->no_children;
        $insuredPlan->policy_number     = '';
        $insuredPlan->save();

        $notify[] = ['success', 'Insurance information saved successfully.'];
        return redirect()->route('user.info')->withNotify($notify);
    }

    public function showUserInfo()
    {
        $pageTitle   = 'Your Information';
        $insuredPlan = InsuredPlan::where('user_id', auth()->user()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();

        return view('Template::user.plan_information.user_info', compact('insuredPlan', 'pageTitle'));
    }

    public function storeUserInfo(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'dob'            => 'required|date',
            'gender'         => 'required|in:Male,Female',
            'identification' => 'required|string|max:255',
            'phone_number'   => 'required|string',
        ]);

        $insuredPlan                 = new InsuredPlan();
        $insuredPlan->user_id        = auth()->id;
        $insuredPlan->payment_status = Status::PAYMENT_INITIATE;
        $insuredPlan->name           = $request->name;
        $insuredPlan->dob            = $request->dob;
        $insuredPlan->gender         = $request->gender;
        $insuredPlan->identification = $request->identification;
        $insuredPlan->phone_number   = $request->phone_number;

        $previousPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();
        $insuredPlan->category_id       = $previousPlan->category_id;
        $insuredPlan->member_type       = $previousPlan->member_type;
        $insuredPlan->coverage          = $previousPlan->coverage;
        $insuredPlan->plan_id           = $previousPlan->plan_id;
        $insuredPlan->price             = $previousPlan->price;
        $insuredPlan->renewal_date      = $previousPlan->renewal_date;
        $insuredPlan->validity          = $previousPlan->validity;
        $insuredPlan->spouse_coverage   = $previousPlan->spouse_coverage;
        $insuredPlan->children_coverage = $previousPlan->children_coverage;
        $insuredPlan->no_children       = $previousPlan->no_children;
        $insuredPlan->policy_number     = '';
        $insuredPlan->save();

        $previousPlan->delete();

        $notify[] = ['success', 'Your information saved successfully.'];
        return redirect()->route('user.spouse.info')->withNotify($notify);
    }

    public function showSpouseInfo()
    {
        $pageTitle   = 'Spouse Information';
        $insuredPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();

        return view('Template::user.plan_information.spouse_info', compact('insuredPlan', 'pageTitle'));
    }

    public function storeSpouseInfo(Request $request)
    {
        $request->validate([
            'spouse_name'           => 'nullable|string|max:255',
            'spouse_dob'            => 'nullable|date',
            'spouse_gender'         => 'nullable|in:Male,Female',
            'spouse_identification' => 'nullable|string|max:255',
            'spouse_phone_number'   => 'nullable|string|max:20',
        ]);

        $insuredPlan                        = new InsuredPlan();
        $insuredPlan->user_id               = auth()->id;
        $insuredPlan->payment_status        = Status::PAYMENT_INITIATE;
        $insuredPlan->spouse_name           = $request->spouse_name;
        $insuredPlan->spouse_dob            = $request->spouse_dob;
        $insuredPlan->spouse_gender         = $request->spouse_gender;
        $insuredPlan->spouse_identification = $request->spouse_identification;
        $insuredPlan->spouse_phone_number   = $request->spouse_phone_number;

        $previousPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();
        $insuredPlan->category_id       = $previousPlan->category_id;
        $insuredPlan->member_type       = $previousPlan->member_type;
        $insuredPlan->coverage          = $previousPlan->coverage;
        $insuredPlan->plan_id           = $previousPlan->plan_id;
        $insuredPlan->price             = $previousPlan->price;
        $insuredPlan->renewal_date      = $previousPlan->renewal_date;
        $insuredPlan->validity          = $previousPlan->validity;
        $insuredPlan->spouse_coverage   = $previousPlan->spouse_coverage;
        $insuredPlan->children_coverage = $previousPlan->children_coverage;
        $insuredPlan->no_children       = $previousPlan->no_children;
        $insuredPlan->name              = $previousPlan->name;
        $insuredPlan->dob               = $previousPlan->dob;
        $insuredPlan->gender            = $previousPlan->gender;
        $insuredPlan->identification    = $previousPlan->identification;
        $insuredPlan->phone_number      = $previousPlan->phone_number;
        $insuredPlan->policy_number     = '';
        $insuredPlan->save();

        $previousPlan->delete();

        $notify[] = ['success', 'Spouse information saved successfully.'];
        return redirect()->route('user.nominee.info')->withNotify($notify);
    }

    public function showNomineeInfo()
    {
        $insuredPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();
        $pageTitle = 'Nominee Information';

        return view('Template::user.plan_information.nominee_info', compact('insuredPlan', 'pageTitle'));
    }

    public function storeNomineeInfo(Request $request)
    {
        $request->validate([
            'nominee_relationship'   => 'nullable|string|max:255',
            'nominee_name'           => 'nullable|string|max:255',
            'nominee_dob'            => 'nullable|date',
            'nominee_gender'         => 'nullable|in:Male,Female',
            'nominee_identification' => 'nullable|string|max:255',
            'nominee_phone_number'   => 'nullable|string|max:20',
        ]);

        $insuredPlan                         = new InsuredPlan();
        $insuredPlan->user_id                = auth()->id;
        $insuredPlan->payment_status         = Status::PAYMENT_INITIATE;
        $insuredPlan->nominee_relationship   = $request->nominee_relationship;
        $insuredPlan->nominee_name           = $request->nominee_name;
        $insuredPlan->nominee_dob            = $request->nominee_dob;
        $insuredPlan->nominee_gender         = $request->nominee_gender;
        $insuredPlan->nominee_identification = $request->nominee_identification;
        $insuredPlan->nominee_phone_number   = $request->nominee_phone_number;

        $previousPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();
        $insuredPlan->category_id           = $previousPlan->category_id;
        $insuredPlan->member_type           = $previousPlan->member_type;
        $insuredPlan->coverage              = $previousPlan->coverage;
        $insuredPlan->plan_id               = $previousPlan->plan_id;
        $insuredPlan->price                 = $previousPlan->price;
        $insuredPlan->renewal_date          = $previousPlan->renewal_date;
        $insuredPlan->validity              = $previousPlan->validity;
        $insuredPlan->spouse_coverage       = $previousPlan->spouse_coverage;
        $insuredPlan->children_coverage     = $previousPlan->children_coverage;
        $insuredPlan->no_children           = $previousPlan->no_children;
        $insuredPlan->name                  = $previousPlan->name;
        $insuredPlan->dob                   = $previousPlan->dob;
        $insuredPlan->gender                = $previousPlan->gender;
        $insuredPlan->identification        = $previousPlan->identification;
        $insuredPlan->phone_number          = $previousPlan->phone_number;
        $insuredPlan->spouse_name           = $previousPlan->spouse_name;
        $insuredPlan->spouse_dob            = $previousPlan->spouse_dob;
        $insuredPlan->spouse_gender         = $previousPlan->spouse_gender;
        $insuredPlan->spouse_identification = $previousPlan->spouse_identification;
        $insuredPlan->spouse_phone_number   = $previousPlan->spouse_phone_number;
        $insuredPlan->policy_number         = '';
        $insuredPlan->save();

        $previousPlan->delete();

        $notify[] = ['success', 'Nominee information saved successfully.'];
        return redirect()->route('user.declaration')->withNotify($notify);
    }

    public function showDeclaration()
    {
        $pageTitle   = 'Declaration';
        $insuredPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();

        return view('Template::user.plan_information.declaration', compact('insuredPlan', 'pageTitle'));
    }

    public function storeDeclaration(Request $request)
    {
        $insuredPlan                 = new InsuredPlan();
        $insuredPlan->user_id        = auth()->id;
        $insuredPlan->payment_status = Status::PAYMENT_INITIATE;

        $previousPlan = InsuredPlan::where('user_id', auth()->id)
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->firstOrFail();
        $insuredPlan->category_id            = $previousPlan->category_id;
        $insuredPlan->member_type            = $previousPlan->member_type;
        $insuredPlan->coverage               = $previousPlan->coverage;
        $insuredPlan->plan_id                = $previousPlan->plan_id;
        $insuredPlan->price                  = $previousPlan->price;
        $insuredPlan->renewal_date           = $previousPlan->renewal_date;
        $insuredPlan->validity               = $previousPlan->validity;
        $insuredPlan->spouse_coverage        = $previousPlan->spouse_coverage;
        $insuredPlan->children_coverage      = $previousPlan->children_coverage;
        $insuredPlan->no_children            = $previousPlan->no_children;
        $insuredPlan->name                   = $previousPlan->name;
        $insuredPlan->dob                    = $previousPlan->dob;
        $insuredPlan->gender                 = $previousPlan->gender;
        $insuredPlan->identification         = $previousPlan->identification;
        $insuredPlan->phone_number           = $previousPlan->phone_number;
        $insuredPlan->spouse_name            = $previousPlan->spouse_name;
        $insuredPlan->spouse_dob             = $previousPlan->spouse_dob;
        $insuredPlan->spouse_gender          = $previousPlan->spouse_gender;
        $insuredPlan->spouse_identification  = $previousPlan->spouse_identification;
        $insuredPlan->spouse_phone_number    = $previousPlan->spouse_phone_number;
        $insuredPlan->nominee_relationship   = $previousPlan->nominee_relationship;
        $insuredPlan->nominee_name           = $previousPlan->nominee_name;
        $insuredPlan->nominee_dob            = $previousPlan->nominee_dob;
        $insuredPlan->nominee_gender         = $previousPlan->nominee_gender;
        $insuredPlan->nominee_identification = $previousPlan->nominee_identification;
        $insuredPlan->nominee_phone_number   = $previousPlan->nominee_phone_number;
        $insuredPlan->policy_number          = '';
        $insuredPlan->save();

        $previousPlan->delete();

        $notify[] = ['success', 'Declaration submitted successfully.'];
        return redirect()->route('user.payment', $insuredPlan->id)->withNotify($notify);
    }

    public function showPayment($insuredPlanId)
    {
        $insuredPlan = InsuredPlan::findOrFail($insuredPlanId);
        $pageTitle   = 'Payment';

        return view('Template::user.plan_information.payment', compact('insuredPlan', 'pageTitle'));
    }

    public function processPayment(Request $request, $insuredPlanId)
    {
        $insuredPlan                 = InsuredPlan::findOrFail($insuredPlanId);
        $insuredPlan->payment_status = Status::PAYMENT_SUCCESS;

        $year       = now()->year;
        $prefix     = 'POL-' . $year;
        $lastPolicy = InsuredPlan::where('policy_number', 'LIKE', $prefix . '-%')
            ->orderBy('policy_number', 'desc')
            ->first();

        $sequence     = $lastPolicy ? (int) substr($lastPolicy->policy_number, -4) + 1 : 1;
        $policyNumber = $prefix . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

        $insuredPlan->policy_number = $policyNumber;
        $insuredPlan->save();

        $this->savePolicyHolders($insuredPlan);

        $notify[] = ['success', 'Insurance application completed successfully! Your policy number is ' . $policyNumber];
        return redirect()->route('user.home')->withNotify($notify);
    }

    private function savePolicyHolders(InsuredPlan $insuredPlan)
    {
        $selfHolder                   = new PolicyHolder();
        $selfHolder->plan_purchase_id = $insuredPlan->id;
        $selfHolder->type             = Status::SELF_INFO;
        $selfHolder->name             = $insuredPlan->name;
        $selfHolder->age              = $this->calculateAge($insuredPlan->dob);
        $selfHolder->other_details    = //viserform
        $selfHolder->save();

        if ($insuredPlan->spouse_name) {
            $spouseHolder                   = new PolicyHolder();
            $spouseHolder->plan_purchase_id = $insuredPlan->id;
            $spouseHolder->type             = Status::SPOUSE_INFO;
            $spouseHolder->name             = $insuredPlan->spouse_name;
            $spouseHolder->age              = $this->calculateAge($insuredPlan->spouse_dob);
            $spouseHolder->other_details    = //visreform
            $spouseHolder->save();
        }

        if ($insuredPlan->nominee_name) {
            $nomineeHolder                   = new PolicyHolder();
            $nomineeHolder->plan_purchase_id = $insuredPlan->id;
            $nomineeHolder->type             = Status::NOMINEE_INFO;
            $nomineeHolder->name             = $insuredPlan->nominee_name;
            $nomineeHolder->age              = $this->calculateAge($insuredPlan->nominee_dob);
            $nomineeHolder->other_details    = //visreform
            $nomineeHolder->save();
        }

        // if ($insuredPlan->children_coverage && $insuredPlan->no_children > 0) {
        //     for ($i = 1; $i <= $insuredPlan->no_children; $i++) {
        //         $childHolder = new PolicyHolder();
        //         $childHolder->plan_purchase_id = $insuredPlan->id;
        //         $childHolder->type = Status::CHILDREN_INFO;
        //         $childHolder->name = "Child " . $i;
        //         $childHolder->age = '';
        //         $childHolder->other_details = json_encode([
        //             ''
        //         ]);
        //         $childHolder->save();
        //     }
        // }
    }

    private function calculateAge($dob)
    {
        if (! $dob) {
            return 'Not specified';
        }

        $birthDate = \Carbon\Carbon::parse($dob);
        $years     = $birthDate->diffInYears(\Carbon\Carbon::now());

        return $years . ' Years';
    }
}
