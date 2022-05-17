<?php

// module name
$HmvcMenu["ticket"] = array(
    //set icon
    "icon" => "<i class='fa fa-ticket'></i>",

    // passenger
    // "passenger" => array(
    //     'add' => array(
    //         "controller" => "passenger",
    //         "method" => "form",
    //         "permission" => "create",
    //     ),
    //     'list' => array(
    //         "controller" => "passenger",
    //         "method" => "index",
    //         "permission" => "read",
    //     ),
    // ),

    // booking
    "booking" => array(
        'add' => array(
            "controller" => "booking",
            "method" => "form",
            "permission" => "create",
        ),

        'list' => array(
            "controller" => "booking",
            "method" => "index",
            "permission" => "read",
        ),
        'akumulasi' => array(
            "controller" => "booking",
            "method" => "akumulasi",
            "permission" => "read",
        ),
        "unpaid_cash_booking_list" => array(
            "controller" => "booking",
            "method" => "unpaisd_cash_booking",
            "permission" => "read",
        ),
    ),

//confirmation

    // refund
    "refund" => array(
        'add' => array(
            "controller" => "refund",
            "method" => "form",
            "permission" => "create",
        ),
        'list' => array(
            "controller" => "refund",
            "method" => "index",
            "permission" => "read",
        ),
    ),

    // feedback
    "feedback" => array(
        "controller" => "feedback",
        "method" => "index",
        "permission" => "read",
    ),

// downtime
    "downtime" => array(
        "controller" => "Downtime",
        "method" => "form",
        "permission" => "update",
    ),

);
