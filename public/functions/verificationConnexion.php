<?php 
if(isset($_SESSION["connecter"]) && isset($_SESSION["id"]))
{
    if( $_SESSION["connecter"] = false)
    {
        header("Location:http://localhost/p5_symfony_php_blog");
    }
}
else{
    header("Location:http://localhost/p5_symfony_php_blog");
}
?>