<?php
namespace Furniture\Controllers;


class Home {

 
    public function home() {

        return ['template' => '../templates/home.html.php',
                'title' => 'Home',
                'variables' => []
                ];
    }

    public function contactUs(){

        return ['template' => '../templates/contactUs.html.php',
        'title' => 'Contact us',
        'variables' => []
        ];

    }

    public function faq(){

        return ['template' => '../templates/faq.html.php',
        'title' => 'Frequently asked questions',
        'variables' => []
        ];

    }
    public function about(){

        return ['template' => '../templates/about.html.php',
        'title' => 'About Us',
        'variables' => []
        ];

    }

}