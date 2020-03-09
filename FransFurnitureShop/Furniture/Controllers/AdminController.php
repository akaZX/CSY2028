<?php

namespace Furniture\Controllers;

 

class AdminController{

   private $adminTable;

    public function __construct($adminTable){
        $this->adminTable = $adminTable;
    }




    public function login(){

        if(isset($_POST['admin'])){     
           
            //$this->adminTable->find('username', $_POST['admin']['username'])[0] throws error 
            $temp  = $this->adminTable->findRows('username', $_POST['admin']['username']);
             
            if( $temp == false ){
                return [
                    'template' => '../templates/adminlogin.html.php',
                    'title' => 'Wrong credentials',
                    'variables' => [],
                ];  

            }else{

                if($temp->password == $_POST['admin']['password']){

                    $_SESSION['logged'] = true;
                    $_SESSION['privil'] = $temp->privil;
                    $_SESSION['user'] = $temp->name;

                    return [
                        'template' => '../templates/adminHome.html.php',
                        'title' => 'Logged in',
                        'variables' => [],
                    ];                

                    } else{
                        return [
                        'template' => '../templates/adminlogin.html.php',
                        'title' => 'Wrong credentials',
                        'variables' => [],
                        ];                        
                    }
            }                
            
        }else{

            return [
                'template' => '../templates/adminlogin.html.php',
                    'title' => 'Failed to login',
                    'variables' => [],
                ];       
        }
    }

    public function save(){

        $this->adminTable->save($_POST['admin']);
        $admins = $this->adminTable->findAll();
        if(!$admins){
            $admins = false;
        }

        return $this->adminList('Account created/updated', 'Account created/updated');
    }
    

    public function delete(){
        $this->adminTable->delete($_POST['admin']['id']);
       
        $admins = $this->adminTable->findAll();
        if(!$admins){
            $admins = false;
        }

        return $this->adminList('User deleted', ' Account has been deleted');
       
    }


    public function edit(){

        if(isset($_GET['admin']['id'])){
        $administrator = $this->adminTable->find('id', $_GET['admin']['id'])[0];

        return [
            'template' => '../templates/adminForm.html.php',
                'title' => 'Edit user',
                'variables' => [
                    'message' => 'Edit administrator: ' . $administrator->name,
                    'administrator' => $administrator
                ],
            ];
        }
        else{
        return [
            'template' => '../templates/adminForm.html.php',
                'title' => 'Create new account',
                'variables' => [                   
                ],
            ];
        }
    }

    public function adminList($title = null, $message = null){

        if($title==null){
            $title = 'Users List';
        }
     
        $admins = $this->adminTable->findAll();
        if(!$admins){
            $admins = false;
        }
        return [
            'template' => '../templates/adminList.html.php',
                'title' => $title,
                'variables' => [
                    'admins' =>  $admins,
                    'message' => $message
                ],
            ];


    }
    public function logout(){
        // destroys all session variables with single function
        session_destroy();      
        header('location: /');    
        die();
    }


    public function home(){

        return [
            'template' => '../templates/adminHome.html.php',
                'title' => 'Welcome',
                'variables' => [],
            ];

    }

}