<?php
include_once 'controller.php';
class Home extends controller {
    public function index() {
        $data = [];
        if(isset($_SESSION["message"])) {
            $data = [
                "message" => $_SESSION["message"]
            ];

            unset($_SESSION["message"]);
        }

        $this->renderPage('home.php', $data);
    }
}