<?php

 class Pages extends Controller {
    public function __construct() {
     $this->postModel = $this->model('Post');
    }
     
  
     public function index(){
      if(!isset($_SESSION['user_id'])) {
         redirect('posts/post');
     }
        $post = $this->postModel->getPosts();
      $data = [
         'title' => 'Shareposts'
         
   ];
        $this->view("pages/index", $data);
    
     }
     public function about(){
      $post = $this->postModel->getPosts();
      $data = [
         'title' => 'About'
         
   ];
      
        $this->view("pages/about", $data);
        
     }
 }