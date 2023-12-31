<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testinomial;
use Illuminate\Http\Request;
use Str;

class TestinomialsController extends Controller
{
    public function index()
    {
        $testinomials = Testinomial::all();
        return view('new_admin.testinomials.list',compact('testinomials'));
    }
    public function addTestinomial()
    {
        return view('new_admin.testinomials.add');
    }
    public function store(Request $request)
    {
        $rules = [
    		'name' => 'required',
        'is_featured'=>'required|in:0,1'
    	];
    	$request->validate($rules);
      $data = $request->all();
        if($request->hasFile('image')){
            $data['image_path'] = uploadFile($request, 'image', 'testinomials');
        }
        if($created = Testinomial::create($data)){

			$notify[] = ['success', 'Testinomial has been added'];
        	return redirect()->route('admin.testinomials.list')->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}
  }
    public function show($id)
    {
       $testinomial = Testinomial::find($id);
       if($testinomial){
         return view('new_admin.testinomials.edit',compact('testinomial'));
       }else{
         $notify[] = ['error', 'Something problem in internal system'];
             return back()->withNotify($notify);
       }
    }

    public function update(Request $request){
          $rules = [
          'name' => 'required',
          'is_featured'=>'required|in:0,1'
        ];
          $request->validate($rules);
    	$data = $request->all();
    	if($request->hasFile('image')){
            $data['image_path'] = uploadFile($request, 'image', 'testinomials');
		}

		$testinomials = Testinomial::find($request->id);
		if($testinomials->update($data)){
			$notify[] = ['success', 'Testinomial has been updated'];
        	return redirect()->route('admin.testinomials.list')->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}
  }
    public function destory($id){
    	$testinomials = Testinomial::find($id);
    	if($testinomials->delete()){

			$notify[] = ['success', 'Testinomial has been deleted'];
        	return back()->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}
    }
}
