<?php
/*
Initialize DB table
*/
    $dbUrl = parse_url(getenv('DATABASE_URL'));
    $dbName = ltrim($dbUrl['path'], '/');
    $dbHost = $dbUrl['host'];
    $dbPort = $dbUrl['port'];
    $dbUser = $dbUrl['user'];
    $dbPass = $dbUrl['pass'];

    $conn = "host=". $dbHost. " dbname=". $dbName . " user=" .$dbUser . " password=". $dbPass;
    pg_connect($conn);

    $sqlresult = pg_query($_con,
     "CREATE TABLE tones(
     id SERIAL,
     tone text,
     created timestamp default CURRENT_TIMESTAMP,
     done boolean default false
     );"
     );
?>
