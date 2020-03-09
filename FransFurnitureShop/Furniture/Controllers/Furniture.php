<?php
namespace Furniture\Controllers;


class Furniture {

    private $furnituresTable;
    private $categoriesTable;  
    private $furnitureTable;  

    public function __construct( $furnituresTable, $categoriesTable, $furnitureTable){
        $this->furnituresTable = $furnituresTable;
        $this->categoriesTable = $categoriesTable;   
        $this->furnitureTable = $furnitureTable;   
    }


    public function edit(){
        $cat = $this->categoriesTable->findAll();
        //var_dump($cat);
        if(isset($_POST['item']['id'])){
            $item = $this->furnitureTable->find('id', $_POST['item']['id'])[0];
            $message ='Edit';
            $title = 'Edit';
        }else{
            $item = null;
            $message = null;
            $title = 'Add new item';
        }
        return [
            'template' => '../templates/furnitureForm.html.php',
                'title' => $title,
                'variables' => [
                    'message' =>$message,
                    'item' =>$item,
                    'cat' => $cat,
                    //    var_dump($cat),
                    //    var_dump($item),
                  
                ]
            ]; 
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


     

        $uploadPath = $currentDir . $uploadDirectory .$fileName;

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
                    $_POST['item']['image'] ='';
                }else{
                    $_POST['item']['image'] = $fileName;

                }
                
                $this->furnituresTable->save($_POST['item']);
                return $this->adminfurnList('Updated furniture list', 'Item created/edited');
       

            }
            return $this->adminNewsList('There was an error');
        }

        $this->furnituresTable->save($_POST['item']);
        return $this->adminfurnList('Updated furniture list', 'Item created/edited');





    }


    public function furnList(){
        //gets all furniture   
        $furniture = $this->furnituresTable->findAll();  
        
        
        if(isset($_GET['condition'])){
            $cond = $_GET['condition'];
        }else{
            $cond = 'all';
        }

        return [
            'template' => '../templates/furniturelistHome.html.php',
                'title' => 'All furniture',
                'variables' => [
                    'furnitures' => $furniture,
                    'category' => $this->categoriesTable->findAll(),
                    'cond' => $cond
                ]
            ];        
    }

    public function furnByDept(){

        if(isset($_GET['id'])){       
                $selectedCat = $this->categoriesTable -> find('id', $_GET['id'])[0];  
                // var_dump($selectedCat);
            if( $selectedCat == null){
                //if id from GET is not in Db then redirects page to all furniture
                header('location: /furniture/all');
                die();
            }else{
                $furniture = $this->furnituresTable->find('categoryId', $_GET['id']); 


                //checks if condition filter is applied
                if(isset($_GET['condition'])){
                    $cond = $_GET['condition'];
                }else{
                    $cond = 'all';
                }
                
                return [
                    'template' => '../templates/furniturelistHome.html.php',
                        'title' => $selectedCat->name,
                        'variables' => [
                            'furnitures' => $furniture,
                            'category' => $this->categoriesTable->findAll(),
                            'selectedCat' =>  $selectedCat,
                            'cond' => $cond
                        ]
                    ];
            }
        }
        else{
            
            header('location: /furniture/all');
        }
    } 
        

    public function delete(){

        $this->furnituresTable->delete($_POST['item']['id']);

        return $this->adminfurnList('Updated list', 'Item deleted');
    }

    public function hide(){

        
        $stock = $this->furnitureTable->find('id', $_POST['item']['id'])[0];       
        
        
       //changes furniture status
        if(strcasecmp($stock->status, 'live')==0){
            $stock->status = 'Hidden';          
            $temp = array('status' => $stock->status, 'id' => $_POST['item']['id']);  
            // var_dump($temp);
            $this->furnituresTable->save($temp);

        }else{
            $stock->status = 'Live';
            $temp = array('status' => $stock->status, 'id' => $_POST['item']['id']); 
            // var_dump($temp);
            $this->furnituresTable->save($temp);
        }        
        //loads list withoyt new title
        return $this->adminfurnList('', 'Item status changed');

    }
    
    public function adminfurnList($title = null, $message = null){

        if($title==null){
            $title = 'All furniture';
        }
        if($message==null){
            $message = 'All furniture';
        }
        //gets all furniture   
        $stock = $this->furnituresTable->findAllDesc();   
        
        if(!$stock){
            $stock = false;
        }
        

        return [
            'template' => '../templates/adminFurnitureList.html.php',
            'title' => $title,
            'variables' => [
            'stock' => $stock, 
            'message'=> $message
            ]
            ];
    
    }
       


}





