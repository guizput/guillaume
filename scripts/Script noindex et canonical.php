<?php


$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

// NOINDEX, FOLLOW
if (
	
	strpos($url,'?') ||
	strpos($url,'/mon-compte/') 
)
{
    echo '<meta name="robots" content="noindex,follow" />';
} else {
    echo '<meta name="robots" content="all" />';
}

// CANONICAL

$sep = strrpos($url, '/page');  
    if($sep != FALSE){  
        $url = substr($url, 0, $sep);
        echo '<link rel="canonical" href="'.$url.'"'.' />';  
    }  

?>