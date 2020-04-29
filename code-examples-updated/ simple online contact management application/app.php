<?php
include_once 'db/PDB.php';

class App {
    private $rootPath = '';
    private $routes = [];
    private $method = '';
    private $requestedRoute = [];
    private $config = [];
    public function __construct() {
        $this->rootPath = __DIR__;
        $this->routes = include_once "routes.php";
        $this->config = include_once "config.php";
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return array|mixed
     */
    public function getConfig($config)
    {
        return isset($this->config[$config])? $this->config[$config]: $this->config ;
    }

    /**
     * @return string
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    public function getUri() {
        $path = explode('?',$_SERVER['REQUEST_URI']);
        if($path[0] == '/') {
            return '/';
        } else {
            return rtrim($path[0], "/")."/";
        }
    }

    public function request() {
        $routes = $this->routes[$this->method];
        $uri = $this->getUri();
        foreach($routes as $key=>$value) {
            if(preg_match('#^'.$key.'$#', $uri, $match)) {
                $this->requestedRoute = $value;
                $this->requestedRoute['match'] = $match;
                return;
            }
        }
        die('Requested url not found.');
    }

    public function run() {

        if(file_exists($this->rootPath.DIRECTORY_SEPARATOR.$this->requestedRoute['class'])) {
            include_once $this->rootPath.DIRECTORY_SEPARATOR.$this->requestedRoute['class'];
            $controller = new $this->requestedRoute['controller']($this);

            if(isset($this->requestedRoute['match'][1])) {

                $controller->{$this->requestedRoute['method']}($this->requestedRoute['match'][1]);
            } else {
                $controller->{$this->requestedRoute['method']}();
            }
            exit();
        } else {
            die('Controller is not exists.');
        }
    }

    public function getUrl($path = '') {
        return $this->config['url'].$path;
    }
}