<?php

namespace App\Http\Trait;

use Illuminate\Support\Facades\Storage;

trait MobileResponse
{
    public function fail($msg)
    {
        $res = [
            "status"=>false,
            "msg"=>$msg,
            "data"=> null
        ];
        return response()->json($res);
    }
    public function success($data)
    {
        $res = [
            "status"=>true,
            "msg"=>"",
            "data"=> $data
        ];
        return response()->json($res);
    }
    public function upload($file,$directory)
    {
        $path = Storage::disk('public')->put($directory,$file,'public');
        return Storage::url($path);
    }
}
