<?php namespace Droit\Service\Worker;

use Droit\Exceptions\FileUploadException;

class UploadWorker implements UploadInterface
{

    /*
	 * upload selected file 
	 * @return array
	*/
    public function upload($file, $destination, $type = null)
    {

        try {
            $name = $file->getClientOriginalName();
            $ext  = $file->getClientOriginalExtension();
            // Get the name first because after moving, the file doesn't exist anymore
            $new  = $file->move($destination, $name);
            $size = $new->getSize();
            $mime = $new->getMimeType();
            $path = $new->getRealPath();

            $image_name =  basename($name, '.'.$ext);
            //resize
            if ($type) {
                $sizes = \Config::get('size.'.$type);
                $this->resize($path, $image_name, $sizes['width'], $sizes['height']);
            }
            //$this->resize( $path, $path , 130, null , true );
            //$this->rename( $path, $name , 'files/test/' );
            $newfile = array( 'name' => $name ,'ext' => $ext ,'size' => $size ,'mime' => $mime ,'path' => $path  );

            return $newfile;
        } catch (Exception $e) {
            throw new \Droit\Exceptions\FileUploadException('Upload failed', $e->getError());
        }

    }
    
    /*
	 * rename file 
	 * @return instance
	*/
    public function rename($file, $name, $path)
    {
        
        $newpath = $path.$name;
        
        return \Image::make($file)->save($newpath);
    }
    
    /*
	 * resize file 
	 * @return instance
	*/
    public function resize($path, $name, $width = null, $height = null)
    {

        $img = \Image::make($path);

        // prevent possible upsizing
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($path);
    }

    /*
     * Scan directory
     * @return array
    */
    public function scan($dir)
    {

        $files = array();

        // Is there actually such a folder/file?
        if (file_exists($dir)) {
            foreach (scandir($dir) as $f) {

                if (!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }

                if (is_dir($dir . '/' . $f)) {

                    // The path is a folder
                    $files[] = array(
                        "name" => $f,
                        "type" => "folder",
                        "path" => $dir . '/' . $f,
                        "items" => $this->scan($dir . '/' . $f) // Recursively get the contents of the folder
                    );
                } else {
                    // It is a file
                    $files[] = array(
                    "name" => $f,
                    "type" => "file",
                    "path" => $dir . '/' . $f,
                    "size" => filesize($dir . '/' . $f) // Gets the size of this file
                    );
                }
            }
        }

        return $files;
    }
}
