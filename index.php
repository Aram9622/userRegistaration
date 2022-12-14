<?php
session_start();
function my_custom_autoloader( $class_name ){
    $file = __DIR__.'/'.$class_name.'.php';
    if ( file_exists($file) ) {

        require_once $file;
    }
}
// add a new autoloader by passing a callable into spl_autoload_register()
spl_autoload_register( 'my_custom_autoloader' );

require_once 'view/layouts/main.php';
