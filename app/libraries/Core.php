<?php

/* APP CORE CLASSES */
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = "index";
    protected $params = [];
   public function __construct() {
       $url = $this->getUrl();
    
       //check for the first part of the url(Classes / Controllers)

       if(file_exists('../app/controllers/' . ucfirst($url[0]) . '.php' )) {
           $this->currentController = ucfirst($url[0]);
           unset($url[0]);
       }

       require_once  '../app/controllers/'. $this->currentController.".php";
       $this->currentController = new $this->currentController;
   //Check for the second part of the url (Method)
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        
   }
    public function getUrl(){
       if(isset($_GET['url']) && !empty($_GET['url'])) {
           $url = rtrim($_GET['url'], '/');
           $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode('/', $url);
            return $url;
       }
    }
}