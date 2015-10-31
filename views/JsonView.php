<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 10/30/15
 * Time: 23:17
 */

require_once("ApiView.php");


class JsonView extends ApiView {
    public function render($content) {
        $header = "HTTP/1.1 {$content['status_code']} " .  $this::get_status_message($content['status_code']);
        header($header);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($content);
        return true;
    }
}
