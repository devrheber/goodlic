<?php

use App\Models\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

function generateResponse($arr, $success, $message, $errors, $type = 'paginated')
{
    // $logs_name = 'generateResponse';
    // if(!$success){
    //     $logs_name = 'errorResponse';
    // }
    // Log::channel($logs_name)->info("$logs_name => ", [ $success, $message,$errors,$type,$_SERVER['REQUEST_URI']]);

    if ($type == 'paginated') {
        if (!isset($arr['data'])) {
            $arr['data'] = [];
        }
        $arr['success'] = $success;
        $arr['message'] = $message;
        $arr['errors'] = $errors;
        return $arr;
    } else {
        $response = [];
        $response['data'] = $arr;
        $response['success'] = $success;
        $response['message'] = $message;
        $response['errors'] = $errors;
        return $response;
    }
}

function uploadFile($request, $file_key = 'file', $folder = 'other')
{

    $time = Carbon::now()->format('Y-M-d-h-i-s');
    $folder_struture = now()->format('Y') . '/' . now()->format('m') . '/';
    $folder  = $folder . '/';
    $folder_location = '/' . $folder_struture . $folder;
    $general = GeneralSetting::first();
    if (($general['upload_file_storage'] ?? 'local') == 's3') {
        $image = $request->file($file_key);
        $filename =  $time . preg_replace('/\s+/', '-', $image->getClientOriginalName());
        $path = Storage::disk('s3')->put($folder_location . $filename, file_get_contents($image), 'public');
        $file_url = 'https://' . env("AWS_BUCKET") . '.s3.' . env("AWS_DEFAULT_REGION") . '.amazonaws.com' . $folder_location  . $filename;
        //   }
    } else {

        $image = $request->file($file_key);
        $filename = $time . preg_replace('/\s+/', '-', $image->getClientOriginalName());
        $destinationPath = public_path($folder_location);
        $image->move($destinationPath, $filename);
        $file_url = $folder_location  . $filename;
    }

    return $file_url;
}
function uploadMultipleFile($request, $file_key = 'file', $folder = 'other')
{
    $files = $request->file($file_key);
    if (!is_array($files)) {
        $files = [$files];
    }
    $time = Carbon::now()->format('Y-M-d-h-i-s');
    $folder_struture = now()->format('Y') . '/' . now()->format('m') . '/';
    $folder  = $folder . '/';
    $folder_location = '/' . $folder_struture . $folder;
    $general = GeneralSetting::first();
    foreach ($files as $key => $file) {
        if (($general['upload_file_storage'] ?? 'local') == 's3') {
            $image = $file;
            $filename =  $time . preg_replace('/\s+/', '-', $image->getClientOriginalName());
            $path = Storage::disk('s3')->put($folder_location . $filename, file_get_contents($image), 'public');
            $file_url = 'https://' . env("AWS_BUCKET") . '.s3.' . env("AWS_DEFAULT_REGION") . '.amazonaws.com' . $folder_location  . $filename;
            //   }
        } else {

            $image = $file;
            $filename = $time . preg_replace('/\s+/', '-', $image->getClientOriginalName());
            $destinationPath = public_path($folder_location);
            $image->move($destinationPath, $filename);
            $file_url = $folder_location  . $filename;
        }

        return $file_url;
    }
}
function fileExtensionValidator(array $allowed_extensions, $file)
{
    $error = collect();
    $error['file'] = ['The file must be a file of type: ' . implode(', ', $allowed_extensions)];
    if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed_extensions)) {
        return [
            'status' => false,
            'error' => $error
        ];
    }
    return [
        'status' => true,
        'error' => null
    ];
}

?>
