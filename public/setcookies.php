<?php 
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}
$future=time()+86400;
var_dump($_COOKIE);

// exit;
extract($_GET);
// echo $userType;
setcookie('userType',$userType,$future);
?>