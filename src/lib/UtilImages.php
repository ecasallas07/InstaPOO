<?php

namespace Ecasa\Instagram\lib;

class UtilImages{

    public static function stroeTime(array $photo) : string
    {
        $target_dir = "public/img/photos"; //ruta donde se guardar la imagen
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-2];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOK = 1;

        $chechk = getimagesize($photo["tmp_name"]);

        if($chechk != false )
        {
            $uploadOK = 1;
        }else{
            $uploadOK = 0;
        }

        if( $uploadOK = 0)
        {
            throw new \Exception("Sorry, your file was not uploaded");
            return "";
        }else{
            if(move_uploaded_file($photo["tmp_name"],$target_file))
            {
                return $hash;
            }else{
                return "";
            }
        }
    }
}