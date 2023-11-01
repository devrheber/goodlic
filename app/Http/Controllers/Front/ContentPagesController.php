<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentPagesController extends Controller
{
    public function getContentPages(Request $request){
        $token="123";
        if ($request->token==$token){
            $content_pages=ContentPage::where('is_active',1)->get();
            $obj=["Status"=>true,"success"=>1,"data"=>["content_pages"=>$content_pages],"msg"=>"Successfully got Content Pages"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    public function getContentPage(Request $request)
    {
        $slug = $request->slug;
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
        ]);
        if ($validator->fails()) {

            $obj = ["Status" => false, "success" => 0, "errors" => $validator->errors()];
            return response()->json($obj);
        }
        $token = "123";
        if ($request->token == $token) {
            $page = ContentPage::where('slug', $slug)->first();
            $obj = ["Status" => true, "success" => 1, "data" => ["page" => $page], "msg" => "Successfully fetched  Content Page"];
            return response()->json($obj);
        }
        $obj = ["Status" => false, "success" => 0, "msg" => "Token Incorrect"];
        return response()->json($obj);
    }
}
