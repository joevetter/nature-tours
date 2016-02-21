<?php

print_r(parse_ini_file(__DIR__ . "/../bootstrap/.env"));

echo "<br><br>";

if(password_verify('123', 
    '$2y$10$T58v637NDqKH7k4SdFoPV.e3/6H/uvtgHwaEKBL23xgQnlP93IO5e'))
{
  echo "->ja";
} else {
  echo "->nein ";# . password_hash('123', PASSWORD_DEFAULT);
}
