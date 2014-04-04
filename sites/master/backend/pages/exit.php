<?php 
unset($_SESSION['authed']);
redirect(getownurl(null,"auth"));
?>