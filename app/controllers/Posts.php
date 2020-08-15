<?php

class Posts extends Controller{
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
    }
    public function index(){
        $posts = $this->postModel->getPosts();
                $data = [
                    'posts' => $posts
                ];
         $this->view('posts/index', $data);
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => ''
    ];

    if(empty($data['title'])) {
          $data['title_err'] = "Please enter title .";
    }
    if(empty($data['body'])) {
        $data['body_err'] = "Please enter body text .";
  }
  if(empty($data['title_err']) && empty($data['body_err'])) {
      if($this->postModel->addPost($data)) {
        flash('post_success', 'Your post is submitted .');
        redirect('posts/post');
      }else{
          die('Something went wrong');
      }

  }else{
      $this->view('posts/add', $data);
  }
        }else{

            $data = [
                'title' => '',
                'body' => ''
            ];
     $this->view('posts/add', $data);

        }
        
     

    } 


    
    public function edit($id) {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
          'id' => $id,
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'title_err' => '',
        'body_err' => ''
    ];
    $this->view('posts/edit', $data);

    if(empty($data['title'])) {
          $data['title_err'] = "Please enter title .";
    }
    if(empty($data['body'])) {
        $data['body_err'] = "Please enter body text .";
  }
  if(empty($data['title_err']) && empty($data['body_err'])) {
      if($this->postModel->updatePost($data)) {
        flash('post_success', 'Post updtaed .');
        redirect('posts/edit/'.$id);
        
      }else{
          die('Something went wrong');
      }

  }else{
      $this->view('posts/edit', $data);
  }
        }else{
            $post = $this->postModel->getPostsById($id); 
            if($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
     $this->view('posts/edit', $data);

        }
        
     

    } 
  public function  delete($id) {
      if($_SERVER['REQUEST_METHOD'] == "POST") {
      if($this->postModel->deletePost($id)) {
        flash('post_message', 'Your Post is removed');
        redirect('posts/index');
      }else{
          die('Wrong');
      }
      }else{

      }
  }


    public function show($id) {
        $posts = $this->postModel->getPostsById($id);
       

       if($posts) {
        $userId = $this->postModel->findUserById($posts->user_id);
        $data = [
            'posts' => $posts,
            'user' => $userId
        ];
       
        $this->view('posts/show', $data);
       }else{
           redirect('posts/index');
       }
    }

}