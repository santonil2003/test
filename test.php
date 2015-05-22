<?php 
$path = direname(__DIR__); 

chdir($path);

shell_exec("git stash");

echo shell_exec("git pull origin master");

shell_exec("git stash pop");
