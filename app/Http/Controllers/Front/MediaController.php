<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $files = $request->file('file');
        if (!is_array($files)) {
            $files = [$files];
        }
        $file_details = [];
        foreach ($files as $key => $file) {
            $image = $file;
            $file_size = $image->getSize() / 1024;

            $file_url = uploadMultipleFile($request, 'file', 'booked_appointment_media');
            $file_details['url'] = $file_url;
            $file_details['name'] = $image->getClientOriginalName();
            $file_details['file_type'] = $image->getClientOriginalExtension();
            $file_details['size'] = $file_size;
            $file_details['description'] = null;
            $file_details['booking_appointment_id'] = null;
            $media = Media::create($file_details);
        }

        $obj = ["Status" => true, "success" => 1, "data" => ["file_details" => $media], "msg" => "File Uploaded Successfully"];

        return response()->json($obj);
    }
    public function DeleteMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'media_id' => 'required',
        ]);
        if ($validator->fails()) {

            $obj = ["Status" => false, "success" => 0, "errors" => $validator->errors()];
            return response()->json($obj);
        }
        $token = "123";
        if ($request->token == $token) {

            $media = Media::find($request->media_id);
            if ($media) {
                $media->delete();
                $obj = ["Status" => true, "success" => 1, "msg" => "Media Successfully Deleted"];
            } else {
                $obj = ["Status" => false, "success" => 0, "msg" => "Media does not Exist"];
            }

            return response()->json($obj);
        }
        $obj = ["Status" => false, "success" => 0, "msg" => "Token Incorrect"];
        return response()->json($obj);
    }
}
