<?php
abstract class controller {
    protected $app;
    protected $db;
    protected $viewPath = '';
    protected $header = 'header.php';
    protected $footer = 'footer.php';

    public function __construct($app) {
        $this->app = $app;
        $this->viewPath = $this->app->getRootPath().DIRECTORY_SEPARATOR."view/";
        $this->db = PDB::getInstance($this->app->getConfig('DB'));
    }

    public function renderPage($template = '', $data = []) {
        //add header file.
        extract($data);
        if(file_exists($this->viewPath.$this->header)) {
            include_once $this->viewPath.$this->header;
        }
        if(file_exists($this->viewPath.$template)) {
            include_once $this->viewPath.$template;
        }
        if(file_exists($this->viewPath.$this->footer)) {
            include_once $this->viewPath.$this->footer;
        }
    }

    public function renderJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}