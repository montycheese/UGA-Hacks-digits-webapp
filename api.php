<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 10/30/15
 * Time: 21:14
 */
require_once("php/Request.php");


spl_autoload_register('apiAutoload');

function apiAutoload($classname)
{
    try {
        if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
            $file_name =  __DIR__ . '/controllers/' . $classname . '.php';
            //echo "asdf";//"$file_name";
            if (file_exists($file_name)) {
                include $file_name;
                return true;
            } else {
                throw new Exception("controller doesn't exist");
            }

        } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
            include __DIR__ . '/models/' . $classname . '.php';
            return true;
        } elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
            include __DIR__ . '/views/' . $classname . '.php';
            return true;
        }
        return false;

    }
    catch(Exception $e){
        $view = new JsonView();
        $view->render(Array("status_code"=>404, "message"=>"Method not found"));
    }

}

$request = new Request();

// route the request to the right place
$controller_name = ucfirst($request->url_elements[1]) . 'Controller';
if (class_exists($controller_name)) {
    $controller = new $controller_name();
    $action_name = strtolower($request->verb) . 'Action';
    $result = $controller->$action_name($request);
    //print_r($result);
    $view_name = ucfirst($request->format) . 'View';
    if(class_exists($view_name)) {
        $view = new $view_name();
        $view->render($result);
    }
}

?>
