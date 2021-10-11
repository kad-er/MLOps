<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SSH;
use Log;
use DB;

class ImageUploadControllerFaceAndGenderDetection extends Controller
{
    //
    public function imageUpload()
    {
        return view('faceandgenderdetectionImage');
    }


    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        $filename=$request->file('image')->getClientOriginalName();
        $foo = \File::extension($filename);
        
        
        
        $request->image->storeAs('', $filename, 'gdrive3');
        $request->image->storeAs('', $filename, 'faceandgenderup');
        $data=array('name'=>$filename,"filetype"=>"image","service"=>"face and gender detection","userid"=>$request->ip(),"upfilepath"=>"app/public/faguploads/".$filename,"downfilepath"=>"images/fagoutput/".$filename,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s'));
        DB::table('files')->insert($data);
        /* Store $imageName name in DATABASE from HERE */
        
        
        //sleep(6);
        
        if($request->radio == 'detect_gender'){
        $ssh=SSH::into('production')->define('deploy', array(
            'cd /home/kader/drive/MyDrive/cvlib/',
            'python3 cv.py '.$filename.' detect_gender',
            
        ));
        }else{
        $ssh=SSH::into('production')->define('deploy', array(
            'cd /home/kader/drive/MyDrive/cvlib/',
            'python3 cv.py '.$filename.' detect_face',
            
        ));

    }
        $ssh->task('deploy', function($line){

        Log::info($line);
        });


        $remotePath='/home/kader/drive/MyDrive/cvlib/output/'.$filename;
        $localPath='images/fagoutput/'.$filename;
        
        SSH::into('production')->get($remotePath, $localPath);
        
        $imageName='images/fagoutput/'.$filename;

        $process = SSH::run([
            'cd /home/kader/drive/MyDrive/cvlib/input/',
            'rm -r '.$filename,
        ]);
        $process = SSH::run([
            'cd /home/kader/drive/MyDrive/cvlib/output/',
            'rm -r '.$filename,
        ]);
        //sleep(3);
        return back()
            ->with('successFAGD','You have successfully upload image.')
            ->with('imageFAGD',$imageName); 
    }
}
