<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Template;
use App\MemberList;

class CampaignController extends Controller
{
    /**
      * Create a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
      * Show all campaigns
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $campaigns = Campaign::orderBy('title', 'asc')->get();
        $templates = Template::orderBy('name', 'asc')->get();
        $lists = MemberList::orderBy('name', 'asc')->get();

        return view('campaigns', compact('campaigns', 'templates', 'lists'));
    }

    /**
     * Show campaign with id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::where('id', $id)->first();
        $lists = MemberList::orderBy('name', 'asc')->get();

        if($campaign)
            return view('campaign', compact('campaign', 'lists'));

        return redirect()->route('campaigns')->with('danger', __('Campaign doesn\'t exists'));
    }

    /**
     * Create new campaign
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'listId' => 'required|exists:member_lists,id',
            'start_date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
        ]);

        $time = $request->start_date. " " .$request->start_time.":00";
        $content = '';

        if(isset($request->templateId) && Template::where('id', $request->templateId)->first()){
            $content = Template::where('id', $request->templateId)->first()->content;
        }

        $campaign = new Campaign();
        $campaign->title = $request->title;
        $campaign->content = $content;
        $campaign->list_id = $request->listId;
        $campaign->send_time = $time;
        $campaign->save();

        return redirect()->back()->with('success', __('Campaign has been created'));
    }

    /**
     * Delete template
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->validate($request, [
            'campaignId' => 'required|exists:campaigns,id',
        ]);

        $template = Campaign::where('id', $request->campaignId)->first()->delete();

        return redirect()->back()->with('success', __('Campaign has been deleted'));
    }

    /**
     * Edit campaign
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'campaignId' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'listId' => 'required|exists:member_lists,id',
            'start_date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
        ]);

        $time = $request->start_date. " " .$request->start_time .":00";
        $campaign = Campaign::where('id', $request->campaignId)->first();
        $campaign->title = $request->title;
        $campaign->content = $request->content;
        $campaign->list_id = $request->listId;
        $campaign->send_time = $time;
        $campaign->save();

        return redirect()->back()->with('success', __('Campaign has been updated'));
    }

    /**
     * Change campaign status
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $this->validate($request, [
            'campaignId' => 'required|exists:campaigns,id',
        ]);

        $campaign = Campaign::where('id', $request->campaignId)->first();
        $campaign->active = $campaign->active?0:1;
        $campaign->save();

        return redirect()->back()->with('success', __('Campaign status has been changed'));
    }
}
