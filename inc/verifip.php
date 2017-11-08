<?php

if (isset($_SESSION['ip'])){
    if(getIP() !== $_SESSION['ip']){
        header("Location: disconnect.php");
    }
}
 ?>
