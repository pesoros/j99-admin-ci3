<?php
// module directory name
$HmvcConfig['manifest']["_title"]     = "Manifest";
$HmvcConfig['manifest']["_description"] = "Manifest information";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['manifest']['_database'] = true;
$HmvcConfig['manifest']["_tables"] = array( 
	'manifest' ,
	'trip_location',
	'trip'
);
