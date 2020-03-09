<?php

namespace Furniture\Entity;


class Furniture{
    private $categoriesTable;
    private $categoryId;
   


    public function __construct(\CSY2028\DatabaseTable $categoriesTable) {
        $this->categoriesTable = $categoriesTable;
        }
       

    public function getCategory() {
       
        
        $category = $this->categoriesTable->find('id', $this->categoryId)[0];
        if(!$category){
            $category = false;
        }

        return $category;
        }



}