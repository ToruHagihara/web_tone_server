<?php
/*
Initialize DB table
*/
    echo 'Initializing DB';
    $dbUrl = parse_url(getenv('DATABASE_URL'));
    $dbName = ltrim($dbUrl['path'], '/');
    $dbHost = $dbUrl['host'];
    $dbPort = $dbUrl['port'];
    $dbUser = $dbUrl['user'];
    $dbPass = $dbUrl['pass'];

    $conn = "host=". $dbHost. " dbname=". $dbName . " user=" .$dbUser . " password=". $dbPass;
    echo 'Start connecting to DB';
    $_con = pg_connect($conn);
    echo 'Finish connecting to DB';

    echo 'Start creating table';
    $sqlresult = pg_query($_con,
     "CREATE TABLE tones(
     id SERIAL,
     tone text,
     created timestamp default CURRENT_TIMESTAMP,
     done boolean default false
     );"
     );
     echo 'Finish creating table';
     echo 'Complite Initializing DB';
?>
