<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;

class TemplateController extends Controller
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
      * Show all templates
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $templates = Template::orderBy('name', 'asc')->get();

        return view('templates', compact('templates'));
    }

    /**
     * Show template with id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::where('id', $id)->first();

        if($template)
            return view('template', compact('template'));

        return redirect()->route('templates')->with('danger', __('Template doesn\'t exists'));
    }

    /**
     * Create new template
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $template = new Template();
        $template->name = $request->name;
        $template->save();

        return redirect()->back()->with('success', __('Template has been created'));
    }

    /**
     * Delete template
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->validate($request, [
            'templateId' => 'required|exists:templates,id',
        ]);

        $template = Template::where('id', $request->templateId)->first()->delete();

        return redirect()->back()->with('success', __('Template has been deleted'));
    }

    /**
     * Edit template
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'templateId' => 'required|exists:templates,id',
            'content' => 'required'
        ]);

        $template = Template::where('id', $request->templateId)->first();
        $template->content = $request->content;
        $template->save();

        return redirect()->back()->with('success', __('Template has been updated'));
    }
}
