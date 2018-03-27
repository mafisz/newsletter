<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberList;

class MemberController extends Controller
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
     * Show all members.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('email', 'asc')->get();

        return view('members', compact('members'));
    }

    /**
     * Show member with id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::where('id', $id)->first();

        if($member){
            $lists = MemberList::get();
            return view('member', compact('member', 'lists'));
        }

        return redirect()->route('members')->with('danger', __('Member doesn\'t exists'));
    }

    /**
     * Create new member
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:members',
        ]);

        $member = new Member();
        $member->email = $request->email;
        $member->save();

        return redirect()->back()->with('success', __('Member has been created'));
    }

    /**
     * Create new members from file
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFromFile(Request $request)
    {
        $this->validate($request, [
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

            $exist = Member::where('email', $email)->first();
            if(!$exist){
                $member = new Member();
                $member->email = $email;
                $member->save();
                $i++;
            }
        }

        return redirect()->back()->with('success', __('New members count: :count', ['count' => $i]));
    }

    

    /**
     * Delete member
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->validate($request, [
            'memberId' => 'required|exists:members,id',
        ]);

        $member = Member::where('id', $request->memberId)->first()->delete();

        return redirect()->back()->with('success', __('Member has been deleted'));
    }
}
