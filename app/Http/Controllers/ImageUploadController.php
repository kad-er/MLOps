<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use SSH;

class ImageUploadController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('traitementImageMedicale');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $filename=$request->file('image')->getClientOriginalName();
        $imageName = $filename.'.'.$request->image->extension();  
        
        
        $request->image->storeAs('', $filename, 'gdrive');
  
        /* Store $imageName name in DATABASE from HERE */
        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Inputs/JPEG_Inputs',
            'python3 test.py',
        ]);
        sleep(6);
        $remotePath='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/JPEG_Outputs/Output_img1.jpeg';
        $localPath='/home/kader/driveupload/public/images/Output_img1.jpg';
        $remotePath2='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/Nifti_Outputs/Output_img1.nii.gz';
        $localPath2='/home/kader/driveupload/public/images/Output_img1.nii.gz';
        SSH::into('production')->get($remotePath, $localPath);
        SSH::into('production')->get($remotePath2, $localPath2);
        $imageName='/images/Output_img1.jpg';

        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Inputs/JPEG_Inputs/',
            'rm *',
        ]);
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}
