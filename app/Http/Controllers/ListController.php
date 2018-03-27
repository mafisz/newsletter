<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberList;
use App\ListMember;

class ListController extends Controller
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
      * Show all member lists.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $lists = MemberList::orderBy('id', 'desc')->get();

        return view('memberLists', compact('lists'));
    }

    /**
     * Show list with id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = MemberList::where('id', $id)->first();

        if($list)
            return view('list', compact('list'));

        return redirect()->route('memberLists')->with('danger', __('List doesn\'t exists'));
    }

    /**
     * Create new member list
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $list = new MemberList();
        $list->name = $request->name;
        $list->save();

        return redirect()->back()->with('success', __('List has been created'));
    }

    /**
     * Delete member list without members
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->validate($request, [
            'listId' => 'required|exists:member_lists,id',
        ]);

        $list = MemberList::where('id', $request->listId)->first()->delete();

        return redirect()->back()->with('success', __('List has been deleted'));
    }

    /**
     * Delete member list with members
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFull(Request $request)
    {
        $this->validate($request, [
            'listId' => 'required|exists:member_lists,id',
        ]);

        $list = MemberList::where('id', $request->listId)->first();

        foreach ($list->members as $listMember) {
            $listMember->member->delete();
        }

        $list->delete();

        return redirect()->back()->with('success', __('List has been deleted'));
    }

    /**
     * Add member to list
     *
     * @return \Illuminate\Http\Response
     */
    public function addMember(Request $request)
    {
        $this->validate($request, [
            'listId' => 'required|string|max:255|exists:member_lists,id',
            'email' => 'required|string|email|max:255',
        ]);

        $member = Member::where('email', $request->email)->first();
        if(!$member){
            $member = new Member();
            $member->email = $request->email;
            $member->save();
        }

        if(!$this->isMember($member->id, $request->listId)){
            $list_member = new ListMember();
            $list_member->member_id = $member->id;
            $list_member->list_id = $request->listId;
            $list_member->save();

            return redirect()->back()->with('success', __('Member has been added to list'));
        }

        return redirect()->back()->with('warning', __('Member already subscribe this list'));
    }

    /**
     * Create new members from file
     *
     * @return \Illuminate\Http\Response
     */
    public function addFromFile(Request $request)
    {
        $this->validate($request, [
            'listId' => 'required|string|max:255|exists:member_lists,id',
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        $file = file_get_contents($request->file('file')->getPathName());
        $file_users = trim($file);
        $file_users = explode(',', $file_users);

        $i = 0;
        foreach ($file_users as $email) {
            $temp_request = new \Illuminate\Http\Request();
            $temp_request->replace(['email' => $email]);

            $this->validate($temp_request, [
                'email' => 'required|string|email|max:255',
            ]);

            $member = Member::where('email', $email)->first();
            if(!$member){
                $member = new Member();
                $member->email = $email;
                $member->save();
            }

            if(!$this->isMember($member->id, $request->listId)){
                $list_member = new ListMember();
                $list_member->member_id = $member->id;
                $list_member->list_id = $request->listId;
                $list_member->save();
                $i++;
            }
        }

        return redirect()->back()->with('success', __('New members count: :count', ['count' => $i]));
    }
    /**
     * check if member already subcribe list
     * @param  [int]  $member_id
     * @param  [int]  $list_id
     * @return boolean  [false if doesnt or Member if subscribe]
     */
    private function isMember($member_id, $list_id){
        $is_member = ListMember::where('member_id', $member_id)->where('list_id', $list_id)->first();

        return $is_member;
    }
}
