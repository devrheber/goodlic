<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use DataTables;
use Str;

class BlogCategoryController extends Controller
{
    public function showBlogCategoryList()
    {

        $blog_categories = BlogCategory::orderBy('id','desc')->get();
        return view('new_admin.blog_category.list',compact('blog_categories'));
    }
    public function addBlogCategory()
    {
        return view('new_admin.blog_category.add');
    }
    public function saveBlogCategory(Request $request)
    {
        $rules = [
    		'name' => 'required|unique:blog_category,name',
    	];

    	$request->validate($rules);


        $data = $request->all();
        $slug = Str::slug($request->name);
        $data['slug']= $slug;
        if($request->hasFile('image')){
            $data['image_path'] = uploadFile($request, 'image', 'blogs');
        }

        if($created = BlogCategory::create($data)){

			$notify[] = ['success', 'Blog Category has been added'];
        	return redirect()->route('admin.blog.category.list')->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}

    }
    public function blogCategoryDetail($id)
    {
       $detail = BlogCategory::find($id);
       return view('new_admin.blog_category.edit',compact('detail'));
    }

    public function blogCategoryUpdate(Request $request){

    	$data = $request->all();

    	if($request->hasFile('image')){
			$data['image_path'] = uploadFile($request, 'image', 'blogs');
		}

		$category = BlogCategory::find($request->id);
		if($category->update($data)){
			$notify[] = ['success', 'Blog Category has been updated'];
        	return redirect()->route('admin.blog.category.list')->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}

    }


    public function blogCategoryDelete($id){
    	$category = BlogCategory::find($id);
    	if($category->delete()){

			$notify[] = ['success', 'Category has been deleted'];
        	return back()->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}
    }
}
