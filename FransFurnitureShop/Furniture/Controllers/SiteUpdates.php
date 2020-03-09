<?php
namespace Furniture\Controllers;

class SiteUpdates {

    private $updatesTable;
  

    public function __construct( $updatesTable){
        $this->updatesTable = $updatesTable; 
    
    }

    public function newsList(){
        $news = $this->updatesTable->findAllDesc();  
        if(!$news){
            $news = false;
        }     
        return [
            'template' => '../templates/home.html.php',
                'title' => 'Posts list',
                'variables' => [
                    'news' => $news
                ]
            ];        
    }

    public function adminNewsList($message = null){
        $news = $this->updatesTable->findAllDesc();  
        if(!$news){
            $news = false;
        }     

        return [
            'template' => '../templates/newsList.html.php',
                'title' => 'Posts list',
                'variables' => [
                    'news' => $news,
                    'message' =>$message
                ]
            ];        
    }

    public function add(){
        
        if(isset($_POST['new']['id'])){
            $new = $this->updatesTable->find('id', $_POST['new']['id'])[0];
            $message ='Edit';
            $title = 'Edit post';
        }else{
            $new = false;
            $message = 'Create new update';
            $title = 'Add new post';
        }
        return [
            'template' => '../templates/addUpdate.html.php',
                'title' => $title,
                'variables' => [
                    'message' =>$message,
                    'new' =>$new
                ]
            ]; 
    }


    public function delete(){       
        $this->updatesTable->delete($_POST['new']['id']);
        header('location: /admin/managenews');
        die();

    }

    
    public function save(){

        $currentDir = getcwd();
        $uploadDirectory = "/images/uploads/";

        $warnings = []; // Store all foreseen and unforseen errors here

        $fileExtensions = ['jpeg', 'jpg', 'png']; // Get all the file extensions

        $fileName = $_FILES['myfile']['name'];
        $fileSize = $_FILES['myfile']['size'];
        $fileTmpName = $_FILES['myfile']['tmp_name'];
        $fileType = $_FILES['myfile']['type'];
        $tmp = explode('.', $fileName);
        $tmpp = end($tmp);
        $fileExtension = strtolower($tmpp);


    
        

        $uploadPath = $currentDir . $uploadDirectory . $fileName;

        if (!in_array($fileExtension, $fileExtensions)) {
            $warnings[] = "<h1>Please upload a JPEG or PNG file</h1>";
        }

        if ($fileSize > 10000000) {
            $warnings[] = "<h1>File is larger than 10MB</h1>";
        }

        if (empty($warnings)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {

                if($fileName == null){
                    $_POST['new']['image'] ='';
                }else{
                    $_POST['new']['image'] =  $fileName;

                }
                
                 $this->updatesTable->save($_POST['new']);
                 return $this->adminNewsList('News post created');
       

            }
            return $this->adminNewsList('There was an error');
        }
        $this->updatesTable->save($_POST['new']);
        return $this->adminNewsList('News post created/edited');


       
    } 
}  