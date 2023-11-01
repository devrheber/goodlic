<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Mentee;
use Illuminate\Support\Facades\Storage;

class MenteeProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'country' => 'required',
            'state_id' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'city' => 'required|string',
        ]);
        if ($validator->fails()) {

            $obj = ["Status" => false, "success" => 0, "errors" => $validator->errors()];
            return response()->json($obj);
        }
        $token = "123";
        if ($request->token == $token) {
            $file_name = '';
            $user = User::find($request->user_id);
            if ($request->hasFile('picture')) {
                $file_name= uploadFile($request, 'picture', 'mentee_profile');
            }
            if (!empty($request->email)) {
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'state_id' => $request->state_id,
                    'image_path' => !empty($file_name) ? $file_name : $user->image_path,
                    'country' => $request->country,
                    'city' => $request->city,
                    'dob' => date('Y-m-d', strtotime($request->dob))

                ]);
                $user->mentee()->update(
                    [
                        'is_profile_completed' => 1
                    ]
                );
            } else {
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'state_id' => $request->state_id,
                    'gender' => $request->gender,
                    'image_path' => !empty($file_name) ? $file_name : $user->image_path,
                    'country' => $request->country,
                    'city' => $request->city,
                    'dob' => date('Y-m-d', strtotime($request->dob))

                ]);
                $user->mentee()->update(
                    [
                        'is_profile_completed' => 1
                    ]
                );
            }


            $obj = ["Status" => true, "success" => 1, "msg" => "Successfully Updated Profile"];
            return response()->json($obj);
        }
        $obj = ["Status" => false, "success" => 0, "msg" => "Token Incorrect"];
        return response()->json($obj);
    }
    public function getMenteeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {

            $obj = ["Status" => false, "success" => 0, "errors" => $validator->errors()];
            return response()->json($obj);
        }
        $token = "123";
        if ($request->token == $token) {
            $user = User::with('user_country', 'mentee')->find($request->user_id);
            $obj = ["Status" => true, "success" => 1, "data" => ["user" => $user], "msg" => "Successfully Updated Profile"];
            return response()->json($obj);
        }
        $obj = ["Status" => false, "success" => 0, "msg" => "Token Incorrect"];
        return response()->json($obj);
    }
    public function toggleIdentityVisiblity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'visibility' => 'required'
        ]);
        if ($validator->fails()) {

            $obj = ["Status" => false, "success" => 0, "errors" => $validator->errors()];
            return response()->json($obj);
        }
        $token = "123";
        if ($request->token == $token) {
            $user = Mentee::where('user_id', $request->user_id)->update(['identity_hidden' => $request->visibility]);
            $obj = ["Status" => true, "success" => 1, "msg" => "Successfully Updated Visiblity for Profile"];
            return response()->json($obj);
        }
        $obj = ["Status" => false, "success" => 0, "msg" => "Token Incorrect"];
        return response()->json($obj);
    }
}
