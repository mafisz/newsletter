<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberList;
use Illuminate\Support\Facades\Input;

class MemberController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['unsubscribe', 'unsubscribe_success']]);
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
        $member->code = str_random(60);
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
                $member->code = str_random(60);
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

    /**
     * Unsubscribe member
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe()
    {
        if(Input::has('email') && Input::has('code')){
            $email = Input::get('email');
            $code = Input::get('code');
            
            $member = Member::where('code', $code)->where('email', $email)->delete();
            return redirect()->route('unsubscribe_success');
        }

        return 'błąd';
    }

    /**
     * Unsubscribe success
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe_success()
    {
        return view('unsubscribe_success');
    }

}
