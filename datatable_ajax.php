<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/db.php';
$table = 'user_info';
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'first_name', 'dt' => 0 ),
    array( 'db' => 'last_name',  'dt' => 1 ),
    array( 'db' => 'mail_address',   'dt' => 2 ),
    array(
        'db'        => 'creation_date',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
);
$sql_details = array(
    'user' => $dbusername,
    'pass' => $dbpassword,
    'db'   => $dbname,
    'host' => 'localhost'
);
 
 
require( 'ssp.class.pgsql.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);