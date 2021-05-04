<?php

require 'config.php';

if($WEB_URL){
   header("Location: " . $WEB_URL);
}

?>