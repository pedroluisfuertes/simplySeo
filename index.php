<?php

    require_once __DIR__.'/app/vendor/autoload.php';
    require_once __DIR__.'/app/tools/Request.class.php';


    function render(string $view, Array $arguments = [], String $viewsPath = 'app/html'){
        $twig = new \Twig\Environment((new \Twig\Loader\FilesystemLoader($viewsPath)));
        return $twig->load($view)->render($arguments); 
    }


    $request = new Request(); 

    switch ($request->getElement(0)) {
        case 'sites':
            require_once __DIR__.'/app/controllers/sites.php';
            break;
        case 'posts':
            require_once __DIR__.'/app/controllers/posts.php';
            break;
        default:
            echo render('index.html');
            break;
    }
    /*
    if(){
        echo render('index.html');
    }elseif ($request->methodIsPost()) {
        switch ($request->getParam('action')) {
            case 'newSite':
                require_once __DIR__.'/newSite.php';
                break;
            case 'newPost':
                
                break;
            
            default:
                # code...
                break;
        }
    }*/



?>