<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use SSH;
use Illuminate\Support\Facades\File;
use DB;

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
        sleep(3);
        $filename=$request->file('image')->getClientOriginalName();
        //$imageName = $filename.'.nii.'.$request->image->extension();  
        $filenames = pathinfo($filename, PATHINFO_FILENAME);
        $file=pathinfo($filenames, PATHINFO_FILENAME);

        
        $request->image->storeAs('', $filename, 'gdrive');

        $request->image->storeAs('', $filename, 'skinsegup');
        $data=array('name'=>$filename,"filetype"=>"nifti file","service"=>"skin segmentation","userid"=>$request->ip(),"upfilepath"=>"app/public/skinseguploads/".$filename,"downfilepath"=>'images/skinsegoutput/'.$file.'_output.jpg',"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s'));
        DB::table('files')->insert($data);
        /* Store $imageName name in DATABASE from HERE */
        $localPath2='images/skinsegoutput/'.$file.'_output.nii.gz';
        $localPath='images/skinsegoutput/'.$file.'_output.jpg';
        /*File::delete($localPath);
        File::delete($localPath2);*/
        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Script/',
            'python3 test.py '.$filename,
        ]);
        //sleep(6);
        $remotePath='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/JPEG_Outputs/'.$file.'_output.jpg';
        
        $remotePath2='/home/kader/drive/MyDrive/Copy of Skin_Segmentation/Outputs/Nifti_Outputs/'.$file.'_output.nii.gz';
        
        
        
        SSH::into('production')->get($remotePath, $localPath);
        SSH::into('production')->get($remotePath2, $localPath2);
        $imageName='images/skinsegoutput/'.$file.'_output.jpg';
        $imagenifti='images/skinsegoutput/'.$file.'_output.nii.gz';
        //sleep(3);
        $process = SSH::run([
            'cd drive/MyDrive/Copy\ of\ Skin_Segmentation/Inputs/Nifti_images/',
            'rm '.$filename,
            'cd ../../Outputs/JPEG_Outputs/',
            'rm '.$file.'_output.jpg',
            'cd ../Nifti_Outputs/',
            'rm '.$file.'_output.nii.gz',
        ]);
        //sleep(2);
        return redirect()->to('/traitement-image-medicale')
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName)
            ->with('imagenifti',$imagenifti);
            
    }
}
