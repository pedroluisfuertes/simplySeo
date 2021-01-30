<?php

if($request->methodIsGet()){
    require_once 'app/models/databaseFunctions.php'; 
    $site = getSiteById(1); 
    //var_dump ($site); 
    $cloudinary = parse_ini_file("./app/config/cloudinary.config.php");
    $cloudinary['timestamp'] = date_timestamp_get(date_create());
    $cloudinary['signature'] = hash("sha256","cloud_name=".$cloudinary['cloudName']."&timestamp=".$cloudinary['timestamp']."&username=".$cloudinary['username'].$cloudinary['apiSecret']);
    echo render('posts.html', ["site" => $site, "cloudinary" => $cloudinary]);
}elseif ($request->methodIsPost()) {
    switch ($request->getParam('action')) {
        case 'changeSite':
            
            break;
        case 'addPost':
            addPost($request->getParam('name'), $request->getParam('domain')); 
            break;
        case 'modifySite':
            
            break;
        
        default:
            # code...
            break;
    }
}

function addPost(Type $var = null)
{
    # code...
}

?>
