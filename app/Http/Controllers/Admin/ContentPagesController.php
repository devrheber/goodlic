<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Str;

class ContentPagesController extends Controller
{
    public function showContentPageList()
    {
        $content_pages = ContentPage::orderBy('id', 'desc')->get();
        return view('new_admin.content_pages.list', compact('content_pages'));
    }
    public function addContentPage()
    {
        return view('new_admin.content_pages.add');
    }
    public function saveContentPage(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'is_active' => 'required'
        ];

        $request->validate($rules);
        $data = $request->all();
        $slug = Str::slug($request->name);
        $data['slug'] = $slug;
        if ($created = ContentPage::create($data)) {

            $notify[] = ['success', 'Content Page has been added'];
            return redirect()->route('admin.content_pages.list')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }
    public function contentPageDetail($id)
    {
        $detail = ContentPage::find($id);
        return view('new_admin.content_pages.edit', compact('detail'));
    }

    public function contentPageUpdate(Request $request)
    {

        $data = $request->all();
        $blog = ContentPage::find($request->id);
        if ($blog->update($data)) {
            $notify[] = ['success', 'Content Page has been updated'];
            return redirect()->route('admin.content_pages.list')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }

    public function contentPageDelete($id)
    {
        $blog = ContentPage::find($id);
        if ($blog->delete()) {

            $notify[] = ['success', 'Content Page has been deleted'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }
}
