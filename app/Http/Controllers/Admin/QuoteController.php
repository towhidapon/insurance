<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\QuoteTopic;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $pageTitle = 'Quotes';
        $quotes    = Quote::with('quoteTopic')->orderBy('id', 'desc')->paginate(getPaginate());

        return view('admin.quote.index', compact('pageTitle', 'quotes'));
    }

    public function topic()
    {
        $pageTitle = 'Quote Topics';
        $topics    = QuoteTopic::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.quote.add', compact('pageTitle', 'topics'));
    }

    public function saveTopic(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
        ]);

        $quoteTopic        = new QuoteTopic();
        $quoteTopic->topic = $request->topic;
        $quoteTopic->save();

        $notify[] = ['success', 'Topic added successfully'];
        return back()->withNotify($notify);
    }

    public function updateTopic(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:quote_topics,id',
            'topic' => 'required|string|max:255',
        ]);

        $quoteTopic        = QuoteTopic::findOrFail($request->id);
        $quoteTopic->topic = $request->topic;
        $quoteTopic->save();

        $notify[] = ['success', 'Topic updated successfully'];
        return back()->withNotify($notify);
    }

    public function remove($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();

        $notify[] = ['success', 'quote deleted successfully'];
        return back()->withNotify($notify);
    }

    public function removeTopic($id)
    {
        $topic = QuoteTopic::findOrFail($id);
        $topic->delete();

        $notify[] = ['success', 'Topic deleted successfully'];
        return back()->withNotify($notify);
    }

    public function toggleStatus($id)
    {
        return QuoteTopic::changeStatus($id);
    }

}
