<?php


    if($request->methodIsGet()){
        echo render('sites.html');
    }elseif ($request->methodIsPost()) {
        switch ($request->getParam('action')) {
            case 'changeSite':
                
                break;
            case 'addSite':
                addSite($request->getParam('name'), $request->getParam('domain')); 
                break;
            case 'modifySite':
                
                break;
            
            default:
                # code...
                break;
        }
    }



    function addSite(String $name, String $domain):bool
    {
        $dirPath = __DIR__.'/app/sites/'.$name; 
        if(!is_dir($dirPath)){
            mkdir($dirPath, 0777);
            createConfigFile($name, $domain); 
        }else{
            echo "El sitio ya existe"; 
            return false; 
        }
        

        return true; 
    }

    function createConfigFile(String $name, String $domain):int
    {
        return file_put_contents( __DIR__.'/app/sites/'.$name."/config.php","<?php return; ?>\nname=\"$name\"\ndomain=\"$domain\"");
    }


?>