<?php
namespace Furniture\Controllers;


class clientEnquiries {

    private $userEnquiryTable;

    public function __construct($userEnquiryTable) {
        $this->userEnquiryTable = $userEnquiryTable;
    }
      
    public function submitForm() {
        //submits user enquiry to database
       $enq = $_POST['userQuery'];
       var_dump($enq);
       var_dump($this->userEnquiryTable);
       $this->userEnquiryTable->save($enq);
       header('location: /');

    }

    public function complete(){
        $this->userEnquiryTable->save($_POST['enq']);
        $enqs = $this->userEnquiryTable->findAllDesc();
        if(!$enqs){
            $enqs = false;
        }
        return [
            'template' => '../templates/enqList.html.php',
                'title' => 'Enquiry list',
                'variables' => [  
                    'message'=> 'Enquiry completed',
                    'enqs' =>  $enqs                 
                ],
            ];



    }


    // will retrieve all user enquiries with live status
    public function list(){
        $enqs = $this->userEnquiryTable->findAllDesc();
        if(!$enqs){
            $enqs = false;
        }

        return [
            'template' => '../templates/enqList.html.php',
                'title' => 'Client enquiries',
                'variables' => [
                    'enqs' =>  $enqs
                ],
            ];

    }

}