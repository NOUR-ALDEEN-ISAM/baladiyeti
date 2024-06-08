<?php

namespace App\Http\Controllers;

use App\Http\Trait\MobileResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
   use MobileResponse;
    public function upload(Request  $request)
    {
        $file = $request->file('photo');
        $path = Storage::disk('public')->put('images',$file);
        $url = url(Storage::url($path));
        return $this->success($url);

    }
}

