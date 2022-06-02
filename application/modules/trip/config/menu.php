<?php

// module name
$HmvcMenu["trip"] = array(
    //set icon
    "icon"           => "<i class='fa fa-road'></i>", 

    // location
    "location" => array( 
        'add'    => array( 
            "controller" => "location",
            "method"     => "form",
            "permission" => "create"
        ), 
        'list'  => array( 
            "controller" => "location",
            "method"     => "index",
            "permission" => "read"
        ), 
    ), 

    // route
    "route" => array( 
        'add'    => array( 
            "controller" => "route",
            "method"     => "form",
            "permission" => "create"
        ), 
        'list'  => array( 
            "controller" => "route",
            "method"     => "index",
            "permission" => "read"
        ), 
    ), 

    "schedules" => array(

        'add' => array(
        'controller'  => "shedule",
        'method'      => 'add_shedule',
        'permission'  => 'create'
        ),
        'list' => array(
        'controller'  => "shedule",
        'method'      => 'shedule_list',
        'permission'  => 'create'
        ),
    ),
   "trip" => array(

        'add' => array(
        'controller'  => "trip",
        'method'      => 'form',
        'permission'  => 'create'
        ),
        'list' => array(
        'controller'  => "trip",
        'method'      => 'index',
        'permission'  => 'read'
        ),
    ),

    // assign
    "assigns" => array( 
        'add'    => array( 
            "controller" => "assign",
            "method"     => "form",
            "permission" => "create"
        ), 
        'list'  => array( 
            "controller" => "assign",
            "method"     => "index",
            "permission" => "read"
        ), 
    ), 

    // close
    // "close" => array(  
    //     'list'  => array( 
    //         "controller" => "close",
    //         "method"     => "index",
    //         "permission" => "read"
    //     ), 
    // ), 
  
);
   

 