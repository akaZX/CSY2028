<?php
namespace Furniture;

class Routes implements \CSY2028\Routes {
	public function callControllerAction() {
		require '../database.php';

		
        $enqTable = new \CSY2028\DatabaseTable ($pdo, 'userQuery', 'id');
        $categoriesTable = new \CSY2028\DatabaseTable ($pdo, 'category', 'id');
        $furnituresTable = new \CSY2028\DatabaseTable ($pdo, 'furniture', 'id', '\Furniture\Entity\Furniture', [$categoriesTable]);
        $updatesTable = new \CSY2028\DatabaseTable ($pdo, 'news', 'id');
        $adminTable = new \CSY2028\DatabaseTable ($pdo, 'admin', 'id');
        $enqTable = new \CSY2028\DatabaseTable ($pdo, 'enq', 'id');
        $furnitureTable = new \CSY2028\DatabaseTable ($pdo, 'furniture', 'id');




        $furnitureController = new \Furniture\Controllers\Furniture($furnituresTable, $categoriesTable, $furnitureTable);
        $homeController = new \Furniture\Controllers\Home();
        $enqController = new \Furniture\Controllers\ClientEnquiries($enqTable);
        $updatesController = new \Furniture\Controllers\SiteUpdates($updatesTable);
        $adminController = new \Furniture\Controllers\AdminController($adminTable);	     
        $categoriesController = new \Furniture\Controllers\Categories($categoriesTable, $furnitureTable);	     
       


		$routes = [
            //customer pages
            '' => [
                'GET' => [
                    'controller' => $updatesController,
                    'function' => 'newsList'
                    ]
				],
            'contact' => [
                'GET' => [
                    'controller' => $homeController,
                    'function' => 'contactUs'
				    ],
                'POST' => [
                    'controller' => $enqController,
                    'function' => 'submitForm'
                    ]
                ],
            'FAQ' => [
                'GET'=>[
                    'controller' => $homeController,
                    'function' => 'faq'
                    ]
                ],                
            'about' => [
                'GET'=>[
                    'controller' => $homeController,
                    'function' => 'about'
                    ]
            ],             
            'furniture/all' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'furnList'
                    ]
                ], 

            'furniture/category' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'furnByDept'
                 ]
                ],
            'login' => [
                'GET'=>[
                    'controller' => $adminController,
                    'function' => 'login'
                    ],
                'POST'=>[
                    'controller' => $adminController,
                    'function' => 'login'
                    ]
                ] ,             
            'logout' => [
                'GET'=>[
                    'controller' => $adminController,
                    'function' => 'logout'
                ],
                'loggedin' => true,
                ], 
            'admin/admin_list' => [
                'GET'=>[
                    'controller' => $adminController,
                    'function' => 'adminList'
                ],
                'POST'=>[
                    'controller' => $adminController,
                    'function' => 'manageadmin'
                ],
                'loggedin' => true,
                'privil' => 3,
                ], 
            'admin/adminDelete' => [
                'POST'=>[
                    'controller' => $adminController,
                    'function' => 'delete'
                ],
                'loggedin' => true,
                'privil' => 3,
                ], 
            'admin/newAdmin' => [
                'GET'=>[
                    'controller' => $adminController,
                    'function' => 'edit'
                ],
                'POST'=>[
                    'controller' => $adminController,
                    'function' => 'save'
                ],
                'loggedin' => true,
                'privil' => 3,
                ], 
            'admin/editAdmin' => [
                'GET'=>[
                    'controller' => $adminController,
                    'function' => 'edit'
                ],
                'POST'=>[
                    'controller' => $adminController,
                    'function' => 'save'
                ],
                'loggedin' => true,
                'privil' => 3,
                ], 
            'admin/enqlist' => [
                'GET'=>[
                    'controller' => $enqController,
                    'function' => 'list'
                ],
                'POST'=>[
                    'controller' => $enqController,
                    'function' => 'complete'
                ],     
                'loggedin' => true,           
                ], 

// dealing with posts

            'admin/managenews' => [
                'GET'=>[
                    'controller' => $updatesController,
                    'function' => 'adminNewsList'
                ],
                'POST'=>[
                    'controller' => $updatesController,
                    'function' => 'save'
                ], 
                'loggedin' => true,               
                ], 

            'admin/deletepost' => [
                'GET'=>[
                    'controller' => $updatesController,
                    'function' => 'adminNewsList'
                ],
                'POST'=>[
                    'controller' => $updatesController,
                    'function' => 'delete'
                ], 
                'loggedin' => true,               
                ], 

            'admin/editpost' => [
                'GET'=>[
                    'controller' => $updatesController,
                    'function' => 'adminNewsList'
                ],
                'POST'=>[
                    'controller' => $updatesController,
                    'function' => 'add'
                ], 
                'loggedin' => true,               
                ], 

            'admin/postform' => [
                'GET'=>[
                    'controller' => $updatesController,
                    'function' => 'add'
                ],
                'POST'=>[
                    'controller' => $updatesController,
                    'function' => 'add'
                ], 
                'loggedin' => true,               
                ], 
// Categories
            'admin/catlist' => [
                'GET'=>[
                    'controller' => $categoriesController,
                    'function' => 'catList'
                ],               
                'loggedin' => true,               
                ], 

            'admin/catdelete' => [
                'GET'=>[
                    'controller' => $categoriesController,
                    'function' => 'catList'
                ],               
                'POST'=>[
                    'controller' => $categoriesController,
                    'function' => 'delete'
                ],               
                'loggedin' => true,               
                ], 

            'admin/editcat' => [
                'GET'=>[
                    'controller' => $categoriesController,
                    'function' => 'edit'
                ],   
                'POST'=>[
                    'controller' => $categoriesController,
                    'function' => 'edit'
                ],               
                'loggedin' => true,                           
                ], 

            'admin/savecat' => [
                'GET'=>[
                    'controller' => $categoriesController,
                    'function' => 'catList'
                ],   
                'POST'=>[
                    'controller' => $categoriesController,
                    'function' => 'save'
                ],              
                           
                'loggedin' => true,               
                ], 
// admin furniture links
            'admin/furniturelist' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'adminfurnList'
                ],              
                'loggedin' => true,            
                           
                ], 

            'admin/deleteItem' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'adminfurnList'
                ],      
                'POST'=>[
                    'controller' => $furnitureController,
                    'function' => 'delete'
                ],         
                'loggedin' => true,            
                           
                ], 

            'admin/hideUnhide' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'adminfurnList'
                ],      
                'POST'=>[
                    'controller' => $furnitureController,
                    'function' => 'hide'
                ],         
                'loggedin' => true,            
                           
                ], 
            'admin/furnitureEdit' => [
                'GET'=>[
                    'controller' => $furnitureController,
                    'function' => 'edit'
                ],      
                'POST'=>[
                    'controller' => $furnitureController,
                    'function' => 'edit'
                ],         
                'loggedin' => true,            
                           
                ], 
                'admin/saveItem' => [
                    'GET'=>[
                        'controller' => $furnitureController,
                        'function' => 'adminfurnList'
                    ],      
                    'POST'=>[
                        'controller' => $furnitureController,
                        'function' => 'save'
                    ],         
                    'loggedin' => true,            
                               
                    ], 

                ];

        return $routes;

        // add restrictions 
    }
    
  

    // small functions to limit access
    // checks if user is logged in, if not redirects to login page
	public function loggedIn(){

    if(!isset($_SESSION['logged'])){
            header('location: /');
    }

    }

	public function privil($required){

    if($_SESSION['privil'] < $required){
            header('location: /login');
    }

    }


}