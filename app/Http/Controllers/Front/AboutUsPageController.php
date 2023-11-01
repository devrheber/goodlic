<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUsPage;
use Illuminate\Http\Request;

class AboutUsPageController extends Controller
{
    public function getContentAboutUsPage(Request $request){
        $token="123";
        if ($request->token==$token){
            $about_us_content=AboutUsPage::first();
            $obj=["Status"=>true,"success"=>1,"data"=>["about_us_content"=>$about_us_content],"msg"=>"Successfully got About Us Page"];
            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
}
