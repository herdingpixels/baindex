<?php
  /*
    App Core Class
    Creates URL & loads core controller
    URL format - /controller/method/params
  */

  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
    //  print_r($this->getUrl());
      $url = $this->getUrl();

      // Look in controllers for first value
      if (file_exists('../app/controllers/' . ucwords($url[0]). '.php')) {
        // If exists, set as controller
        $this->currentController = ucwords($url[0]);
        // Unset 0 Index
        unset($url[0]);
      }

      // Require the controller
      require_once '../app/controllers/'. $this->currentController . '.php';

      // Instantiate controller class
      $this->currentController = new $this->currentController;

      // Check for second part of url
      if (isset($url[1])) {
        // Check to see if method exists in controller
        if (method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      // The first param of this function is a callback function, but since
      // the desired callback function is a method of an instantiated object,
      // an array is needed as follows array(object, method_name)
      // Source: http://php.net/manual/en/language.types.callable.php
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
      
    }
  }