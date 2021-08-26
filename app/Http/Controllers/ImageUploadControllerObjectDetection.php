<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SSH;

class ImageUploadControllerObjectDetection extends Controller
{
    //
    public function imageUpload()
    {
        return view('objectdetectionImage');
    }


    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avi|max:2048',
        ]);
        $filename=$request->file('image')->getClientOriginalName();
        
        
        
        $request->image->storeAs('', $filename, 'gdrive2');
  
        /* Store $imageName name in DATABASE from HERE */
        $process = SSH::run([
            'cd /home/kader/drive/MyDrive/ObjectDetection/',
            'python3 detect.py',
        ]);
        sleep(6);
        $remotePath='/home/kader/drive/MyDrive/ObjectDetection/runs/detect/exp/'.$filename;
        $localPath='/home/kader/driveupload/public/images/'.$filename;
        
        SSH::into('production')->get($remotePath, $localPath);
        
        $imageName='images\/'.$filename;

        $process = SSH::run([
            'cd /home/kader/drive/MyDrive/ObjectDetection/runs/detect/',
            'rm -r *',
        ]);
        $process = SSH::run([
            'cd /home/kader/drive/MyDrive/ObjectDetection/data/images/',
            'rm -r *',
        ]);
        return back()
            ->with('successOD','You have successfully upload image.')
            ->with('imageOD',$imageName); 
    }
}
