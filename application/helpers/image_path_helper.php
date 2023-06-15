<?php 
function image_full_path($fileName,$type){
    if($type=='thumbnail'){
        $path='/var/www/htdocs/demo/uploads/thumbnails/'.$fileName;
    }elseif($type=='full'){
        $path='/var/www/htdocs/demo/uploads/'.$fileName;
    }
    
    return $path;
}
?>