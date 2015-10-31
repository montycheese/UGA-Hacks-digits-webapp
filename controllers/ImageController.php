<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 10/30/15
 * Time: 23:13
 */

require_once("DigitController.php");

class ImageController extends DigitController
{
    public function getAction($request) {
        $data = $request->parameters;
        $data['status_code'] = 406;
        $data['message'] = "GET not supported for Image recognition requests";
        return $data;
    }

    public function postAction($request) {
        $data = $request->parameters;
        //do checks
        //if everything is good
        $data['status_code'] = 200;
        $data['message'] = "OK";
        //$url = $data['url'];
        $data['success'] = True;
        return $data;
    }

    public function deleteAction($request){
        $data = $request->parameters;
        $data['message'] = "Deleting stuff";
        return $data;
    }
}

?>