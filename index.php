<?php
$host = "localhost"; 
$user = "root"; 
$pass = "/* fill your own */"; 
$db = "csv"; 
$con = mysql_connect($host, $user, $pass);
if (!$con) {
    echo "Could not connect to server\n";
    die(mysql_error());
} else {
    echo "Connection established\n"; 
}

$con1 = mysql_select_db($db);

if (!$con1) {
    echo "Cannot select database\n";
    die(mysql_error()); 
} else {
    echo "Database selected\n";
}

if (($handle = fopen("/var/www/test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sql = "INSERT INTO record ( id, name, marks) VALUES ( '".mysql_escape_string($data[0])."','".mysql_escape_string($data[1])."','".mysql_escape_string($data[2])."')";
        $query = mysql_query($sql);
        if($query){
            echo "row inserted\n";
        }
        else{
            echo die(mysql_error());
        }
    }
    fclose($handle);
}

?>
