<?php
// module directory name
$HmvcConfig['paket']["_title"]     = "Paket";
$HmvcConfig['paket']["_description"] = "Paket information";


// register your module tables
// only register tables are imported while installing the module
$HmvcConfig['paket']['_database'] = true;
$HmvcConfig['paket']["_tables"] = array( 
	'packet' ,
	'trip_location'
);
