<?php 

class Bootstrap {
    public function dispatch() {
        
    }
}

function __autoload($class_name) {
    $exploded =  explode('_', $class_name);
    if ($exploded[0] == 'Module') {
        array_shift($exploded);
        
        $path = implode('/', $exploded);

        if (sizeof($exploded) === 1) {
            $path .= DIRECTORY_SEPARATOR . $path;
        }
        $filename = 'Application/Modules/'.$path . '.php';
        
        
    } else {
        $path = implode('/', $exploded);
        $filename = '../System/'.$path . '.php';
    }
    
    if (!file_exists($filename)) {
        throw new Exception("Could not autoload ". $class_name);
    }
    
    include $filename;
}


Application::$layoutTemplate = 'layout.tpl.php';


