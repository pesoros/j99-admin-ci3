<?php
// module directory name
$HmvcConfig['resto']["_title"]     = "resto";
$HmvcConfig['resto']["_description"] = "resto information";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['resto']['_database'] = true;
$HmvcConfig['resto']["_tables"] = array( 
	'resto' ,
	'trip_location',
	'trip'
);
