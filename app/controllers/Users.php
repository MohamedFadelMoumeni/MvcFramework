<?php

class Users extends Controller {
    public function __construct() {

        $this->UserModel = $this->model('User');

    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err'=> '',
                'password_err' => '',
                'confirm_password_err' => ''           
            ];

            if(empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }else{
                if($this->UserModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Email exist";
                }
            }
            if(empty($data['name'])) {
                $data['name_err'] = "Please enter a name";
            }
            if(empty($data['password'])) {
                $data['password_err'] = "Please enter a password";
            }elseif(strlen($data['password']) < 5) {
                $data['password_err'] = "Please enter a password that contain more than 6 chars";
            }
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please enter a confirmation password";
            }else{
                if($data['confirm_password'] != $data['password']) {
                    $data['confirm_password_err'] = "passwords not much";
                }
                
            }

           
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->UserModel->register($data)) {
                    flash('register_success', 'You are registered you can login now !');
                 redirect('users/login');
                }else{
                    die("Wrong");
                }
                die("SUCCESS");
            }else{
                $this->view('users/register', $data);
            }

        }else{
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err'=> '',
                'password_err' => '',
                'confirm_password_err' => ''           
            ];


            $this->view('users/register', $data);
        }
    }

    public function login() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
               
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'email_err'=> '',
                'password_err' => '',
                'confirm_password_err' => ''           
            ];
   
            if(empty($data['email'])) {
                $data['email_err'] = "Please enter an email";
            }
            if(empty($data['password'])) {
                $data['password_err'] = "Please enter a password";
            }elseif(strlen($data['password']) < 5) {
                $data['password_err'] = "Please enter a password that contain more than 6 chars";
            }
            if($this->UserModel->findUserByEmail($data['email'])) {

            }else{
                $data['email_err'] = "User not found";
            }

           
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $logged = $this->UserModel->login($data['email'], $data['password']);

                if($logged) {
                    $this->createUserSession($logged);

                }else{
                    $data['password_err'] = "Password incorrect";
                    $this->view('users/login', $data);
                }
            }else{
                $this->view('users/login', $data);
            }
        }else{
            $data = [
                
                'email' => '',
                'password' => '',
                'email_err'=> '',
                'password_err' => '',
                         
            ];
            $this->view('users/login', $data);
        }

    }
    public function createUserSession($logged){
        $_SESSION['user_id'] = $logged->id;
        $_SESSION['user_email'] = $logged->email;
        $_SESSION['user_name'] = $logged->name;
        redirect('posts/index');
    }

    public function index() {
        redirect('users/register');
    }
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
    }
