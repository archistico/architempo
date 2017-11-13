<?php
//echo shell_exec("sudo -u www-data git -C '/var/www/html/architempo' pull origin master 2->&1");
function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "\n");
    }
}
// Print the exec output inside of a pre element
print("<pre>" . execPrint("git pull origin master") . "</pre>");