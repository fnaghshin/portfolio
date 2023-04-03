<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FarzadController extends Controller
{
    public function ImageUploader($file)
    {
        if($file == null)
            return '/uploads/images/noimage.jpg';
        $filename=time()."-".$file->getClientOriginalName();
        $path=public_path('/uploads/images/');
//        $path = str_replace('public','public_html',$path);
        $file->move($path,$filename);
        return "/uploads/images/".$filename;
    }

    public function ImageRemover($file)
    {
        if($file)
        $path = public_path($file);
        @unlink($path);
        return true;
    }

    public function getFileType($mimeType)
    {
        switch ($mimeType)
        {
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/png':
            case 'image/svg+xml':
            case 'image/webp':
            case 'image/x-icon':
            case 'image/gif':
                return 'image';
            case 'application/pdf':
                return 'pdf';
            case 'video/mp4':
            case 'video/mpeg':
            case 'video/ogg':
            case 'video/webm':
            case 'video/x-msvideo':
            case 'video/3gpp':
                return 'video';
            default:
                return null;
        }
    }

    public function LoadSetting()
    {
        $settings = DB::table('settings')->get();
        foreach($settings as $setting)
        {
            define($setting->key,$setting->value);
        }
    }

    public function ckupload(Request $request)
    {
        if($request->hasFile('upload')) {


            //Upload File
            $url = $this->ImageUploader($request['upload']);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

}
