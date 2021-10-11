<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SSH;
use Log;
use DB;

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
        $request->image->storeAs('', $filename, 'objectdetup');
        $data=array('name'=>$filename,"filetype"=>$retfile,"service"=>"object detection","userid"=>$request->ip(),"upfilepath"=>"app/public/objdetuploads/".$filename,"downfilepath"=>'images/objdetoutput/'.$filename,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s'));
        DB::table('files')->insert($data);
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
            'python3 detect2.py --source=data/images/'.$filename,
            
        ));

        $ssh->task('deploy', function($line){

        Log::info($line);
        });


        $remotePath='/home/kader/drive/MyDrive/ObjectDetection/runs/detect/exp/'.$filename;
        $localPath='images/objdetoutput/'.$filename;
        
        SSH::into('production')->get($remotePath, $localPath);
        
        $imageName='images/objdetoutput/'.$filename;

        
        $ssh=SSH::into('production')->define('deploy2', array(
            'cd /home/kader/drive/MyDrive/ObjectDetection/runs/detect/exp',
            'rm -r '.$filename,
            'pwd',
            'echo deleted',
            'cd /home/kader/drive/MyDrive/ObjectDetection/data/images/',
            'rm -r '.$filename,
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
