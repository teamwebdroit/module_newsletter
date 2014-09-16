<?php namespace Droit\Service\Worker;

use Droit\Exceptions\FileUploadException;

class UploadWorker implements UploadInterface {

	/*
	 * upload selected file 
	 * @return array
	*/	
	public function upload( $file , $destination ){

        try
        {
            $name = $file->getClientOriginalName();
            $ext  = $file->getClientOriginalExtension();
            // Get the name first because after moving, the file doesn't exist anymore
            $new  = $file->move($destination,$name);
            $size = $new->getSize();
            $mime = $new->getMimeType();
            $path = $new->getRealPath();
            // test resize
            //$this->resize( $path, $path , 200 , null , true );
            //$this->rename( $path, $name , 'files/test/' );
            $newfile = array( 'name' => $name ,'ext' => $ext ,'size' => $size ,'mime' => $mime ,'path' => $path  );

            return $newfile;
        }
        catch(Exception $e)
        {
            throw new \Droit\Exceptions\FileUploadException('Upload failed', $e->getError() );
        }

	}
	
	/*
	 * rename file 
	 * @return instance
	*/	
	public function rename( $file , $name , $path ){
		
		$newpath = $path.$name;
		
		return Image::make( $file )->save($newpath);
	}
	
	/*
	 * resize file 
	 * @return instance
	*/	
	public function resize( $path, $name , $width = null , $height = null, $ratio ){
		
		return Image::make( $path )->resize($width, $height , $ratio)->save($name);		
	}
    
}