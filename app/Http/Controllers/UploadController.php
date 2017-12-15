<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class UploadController extends Controller
{
    /**
     * 普通上传头像
     *
     * @param Filedata
     * @return Response
     */
    public function uploadImg(Request $request)
    {
        $file = $request->file('Filedata');
        if($file && $file->isValid()){
            $clientName = $file->getClientOriginalName();

            $tmpName = $file->getFileName();

            $realPath = $file->getRealPath();

            $extension = $file->getClientOriginalExtension();

            $mimeTye = $file->getMimeType();

            $newName = md5(date('ymdhis').$clientName).".".$extension;

            $path = $file->move('./uploads/img/'.date('Ymd'),$newName); //这里是缓存文件夹，存放的是用户上传的原图，这里要返回原图地址给flash做裁切用

            return '{"status":"1","url":"' . addcslashes($path, '/') . '"}';

        }
    }
}