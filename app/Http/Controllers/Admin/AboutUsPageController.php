<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsPage;
use Illuminate\Http\Request;

class AboutUsPageController extends Controller
{
    public function index(){
        $content = AboutUsPage::first();
        return view('new_admin.about_us_page.index',compact('content'));
    }
    public function saveAboutUsPage(Request $request)
    {
        $data= $request->all();
        if($request->hasFile('section_1_image')){
            $data['section_1_image'] = uploadFile($request, 'section_1_image', 'about_us');
		}
        if($request->hasFile('section_3_image')){
            $data['section_3_image'] = uploadFile($request, 'section_3_image', 'about_us');
		}
        if($request->hasFile('section_2_first_image')){
            $data['section_2_first_image'] = uploadFile($request, 'section_2_first_image', 'about_us');
		}
        if($request->hasFile('section_2_second_image')){
            $data['section_2_second_image'] = uploadFile($request, 'section_2_second_image', 'about_us');
		}
        if($request->hasFile('section_2_third_image')){
            $data['section_2_third_image'] = uploadFile($request, 'section_2_third_image', 'about_us');
		}
        $record_exist = AboutUsPage::first();
        if ($record_exist) {
            $record_exist->update($data);
            $notify[] = ['success', 'About us Page Content has been updated'];
        	return redirect()->route('admin.about_us_page.list')->withNotify($notify);
        }
        else
        {
            $created = AboutUsPage::create($data);
            $notify[] = ['success', 'About us Page Content has been added'];
        	return redirect()->route('admin.about_us_page.list')->withNotify($notify);
        }
    }
}
