<?php
/**********************************************************************************

header.php
Site wide includes so we only have to include one file across all pages 
Copyright Jonathan Lazar 2015

**********************************************************************************/

define('BASE', '/var/www/html/');
define('BASEURL', 'http://dev.justjon.net/');

//Include our configuration files
require_once BASE.'includes/config.php';

//Load classes
require_once BASE.'classes/marvel.php';
require_once BASE.'classes/spotify.php';


//Connect to memcache
//$memcache = new Memcache();
//$memcache->connect('localhost', 11211) or die ("Could not connect");

//Create the current user
//$db=new Database();
//$user=new User($db, $memcache);


//Avatar image formats
$typelist[0]='image/gif';
$typelist[1]='image/png';
$typelist[2]='image/jpg';
$typelist[3]='image/jpeg';

date_default_timezone_set('America/New_York');
