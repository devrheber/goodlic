<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;

class EmailTemplatesController extends Controller
{
    public function index(){
        $email_templates=EmailTemplate::orderBy('id','asc')->get();
        return view('new_admin.email_templates.list',compact('email_templates'));
    }
    function show($id){

        $email_template = EmailTemplate::find($id);
        if ($email_template) {
            return view('new_admin.email_templates.edit', compact('email_template'));
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $email_template = EmailTemplate::find($request->id);
        if ($email_template->update($data)) {
            $notify[] = ['success', 'Email Template has been updated'];
            return redirect()->route('admin.email_templates.list')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }
}
