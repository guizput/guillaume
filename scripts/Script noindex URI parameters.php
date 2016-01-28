<?php


$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


if (
	strpos($url,'/page-') || 
	strpos($url,'/page/') || 
	strpos($url,'/lesson/')
	) 
{
    echo '<meta name="robots" content="noindex,follow" />';
} else {
    echo '<meta name="robots" content="all" />';
}

?>