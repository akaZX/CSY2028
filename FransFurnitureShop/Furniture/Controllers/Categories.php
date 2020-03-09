<?php
namespace Furniture\Controllers;


class Categories {

    private $categoriesTable;
    //required to update inventory category id if their category is deleted
   private $furnitureTable;

    public function __construct($categoriesTable, $furnitureTable){
        $this->categoriesTable = $categoriesTable;   
        $this->furnitureTable = $furnitureTable;   
    }


    public function catList($message = null){

        $categories = $this->categoriesTable->findAll();
        if(!$categories){
            $categories = false;
        }

        return [
            'template' => '../templates/catList.html.php',
                'title' => 'Categories list',
                'variables' => [ 
                    'categories'=> $categories ,
                    'message' => $message
                        
                ],
            ];
    }


    public function edit(){

        if(isset($_POST['category']['id'])){
            $category = $this->categoriesTable->find('id', $_POST['category']['id'])[0];
            $message ='Edit';
            $title = 'Edit';
        }else{
            $category = false;
            $message = 'Create new category';
            $title = 'Add new category';
        }
        return [
            'template' => '../templates/catForm.html.php',
                'title' => $title,
                'variables' => [
                    'message' =>$message,
                    'category' =>$category
                ]
            ]; 


    }

    public function delete(){

        //reassigns items to first available category this will remove error if when customers views these items
        $furnitures = $this->furnitureTable->find('categoryId', $_POST['category']['id']); 
     

        $this->categoriesTable->delete($_POST['category']['id']);
        $newCategory = $this->categoriesTable->findAll()[0];
        $counter = 0;        
        //updates all items in furniture table with deleted category and reassigns them with new dept
        //there might be performance issues with big data loads and would be better to have one 
        // placeholder category like "no category " which will be undeletable
        foreach ($furnitures as $furniture) {
            $counter++;
            $furniture->categoryId = $newCategory->id;           
            $arr = array('categoryId' => $furniture->categoryId, 'id' => $furniture->id);         
            $this->furnitureTable->save($arr);
        }

        $message = ' Category was deleted and all items in that category
        has been allocated to first category available, number of items relocated: '. $counter;
        return $this->catList($message);

    }

    public function save(){
        $this->categoriesTable->save($_POST['category']);      

        return $this->catList('Category saved');
    }

}




