<?php

echo "it worked";
echo "<br>";
print_r($_REQUEST);

$msg = "register message";

$_SESSION['msg'] = $msg;
header('Location: /register.php');
