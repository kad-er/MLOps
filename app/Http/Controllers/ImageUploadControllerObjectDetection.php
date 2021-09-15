<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SSH;
use Log;

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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4|max:10240',
        ]);
        $filename=$request->file('image')->getClientOriginalName();
        $foo = \File::extension($filename);
        $retfile='';
        if (($foo == 'jpeg') || ($foo == 'jpg') || ($foo == 'png') || ($foo == 'gif') || ($foo == 'svg')){
            $retfile='image';
        }else{
            $retfile='video';
        }
        
        
        $request->image->storeAs('', $filename, 'gdrive2');
  
        /* Store $imageName name in DATABASE from HERE */
        
        
        //sleep(6);
        

        $ssh=SSH::into('production')->define('deploy', array(
            'cd /home/kader/drive/MyDrive/ObjectDetection/',
            'python3 detect.py',
            
        ));

        $ssh->task('deploy', function($line){

        Log::info($line);
        });


        $remotePath='/home/kader/drive/MyDrive/ObjectDetection/runs/detect/exp/'.$filename;
        $localPath='images/'.$filename;
        
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
        //sleep(3);
        return back()
            ->with('successOD','You have successfully upload image.')
            ->with('imageOD',$imageName)
            ->with('typeF',$retfile); 
    }
}
