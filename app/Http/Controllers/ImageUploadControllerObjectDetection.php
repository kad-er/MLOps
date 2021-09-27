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
        Log::info("stored");
        /* Store $imageName name in DATABASE from HERE */
        $ssh=SSH::into('production')->define('deploy1', array(
            'ls -l /home/kader/drive/MyDrive/ObjectDetection/data/images/',
            
        ));
        sleep(2);
        $ssh->task('deploy1', function($line){

            Log::info($line);
            if ($line == 'total 0'){
                sleep(2);
            }
            });
        
        

        $ssh=SSH::into('production')->define('deploy', array(
            'cd /home/kader/drive/MyDrive/ObjectDetection/',
            'sleep 3',
            'python3 detect.py',
            
        ));

        $ssh->task('deploy', function($line){

        Log::info($line);
        });


        $remotePath='/home/kader/drive/MyDrive/ObjectDetection/runs/detect/exp/'.$filename;
        $localPath='images/'.$filename;
        
        SSH::into('production')->get($remotePath, $localPath);
        
        $imageName='images\/'.$filename;

        
        $ssh=SSH::into('production')->define('deploy2', array(
            'cd /home/kader/drive/MyDrive/ObjectDetection/runs/detect/',
            'rm -r *',
            'pwd',
            'echo deleted',
            'cd /home/kader/drive/MyDrive/ObjectDetection/data/images/',
            'rm -r *',
            'pwd',
            'echo deleted',
        ));
                $ssh->task('deploy2', function($line){

            Log::info($line);
            });
            
        
        //sleep(3);
        return back()
            ->with('successOD','You have successfully upload image.')
            ->with('imageOD',$imageName)
            ->with('typeF',$retfile); 
    }
}
