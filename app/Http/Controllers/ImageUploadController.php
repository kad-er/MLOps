<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use SSH;
use Illuminate\Support\Facades\File;

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
            'image' => 'required|mimes:gz|max:2048',
        ]);
        $filename=$request->file('image')->getClientOriginalName();
        $imageName = $filename.'.'.$request->image->extension();  
        
        
        $request->image->storeAs('', $filename, 'gdrive');
  
        /* Store $imageName name in DATABASE from HERE */
        $localPath2='images/Output_img1.nii.gz';
        $localPath='images/Output_img1.jpg';
        File::delete($localPath);
        File::delete($localPath2);
        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Script/',
            'python3 test.py',
        ]);
        sleep(6);
        $remotePath='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/JPEG_Outputs/Output_img1.jpeg';
        
        $remotePath2='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/Nifti_Outputs/Output_img1.nii.gz';
        
        
        
        SSH::into('production')->get($remotePath, $localPath);
        SSH::into('production')->get($remotePath2, $localPath2);
        $imageName='/images/Output_img1.jpg';
        sleep(2);
        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Inputs/Nifti_images/',
            'rm *',
            'cd ../../Outputs/JPEG_Outputs/',
            'rm *',
            'cd ../Nifti_Outputs/',
            'rm *'
        ]);
        
        return redirect()->to('/traitement-image-medicale')
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}
