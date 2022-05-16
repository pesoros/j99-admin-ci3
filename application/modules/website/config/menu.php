<?php

// module name
$HmvcMenu["website"] = array(
    //set icon
    "icon"           => "<i class='fa fa-globe'></i>", 

   'website'  => array( 
        "controller" => "website",
        "method"     => "index",
        "permission" => "read"
    ), 

    // setting
    'application_setting'  => array( 
        "controller" => "setting",
        "method"     => "form",
        "permission" => "update"
    ), 
   
    // Email configuration
    'email'  => array( 
        "controller" => "emails",
        "method"     => "form",
        "permission" => "update"
    ), 
    // offer
    'ticket'  => array( 
        "controller" => "setting",
        "method"     => "offer",
        "permission" => "update"
    ),  
);
   

 