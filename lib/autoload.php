<?php

spl_autoload_register('application_autoloader');



function application_autoloader($class) {
    $class_filename = $class.'.php';
    $class_root = $_SERVER['DOCUMENT_ROOT'].'/ProyectoFinal/ProyectoKarting';

    /* Determine the location of the file within the $class_root and, if found, load and cache it */
    $directories = new RecursiveDirectoryIterator($class_root);
    foreach(new RecursiveIteratorIterator($directories) as $file) {
       
        if ($file->getFilename() == $class_filename) {//echo "Encontrado:".$file->getFilename();
            $full_path = $file->getRealPath();
            include_once $full_path;
            break;
        }
    }   
}
 

?>