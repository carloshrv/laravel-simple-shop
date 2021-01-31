<?php

namespace App\Services;
use Illuminate\Http\Request;
use Exception;
use Storage;



Class UploadService {


public function Upload($request){


    $path_info = $request->file('fileToUpload')->getClientOriginalExtension();

     $request->file('fileToUpload')->storeAs('public/assets/images/VooImages', str_replace(' ', '', $request->get('local_desembarque')) . '.' . $path_info);

    return [
            'path_info' => $path_info,
        ];

}

}
















?>