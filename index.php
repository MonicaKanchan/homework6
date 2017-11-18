<?php

ini_set('dispaly_errors', 'On');
error_reporting(E_ALL);

class dbConn
{
protected static $db;

private function __construct()
{
try
{
self::$db = new PDO( 'mysql:host=sql1.njit.edu; dbname=mk758',
'mk758','MxLEzvEVX');
self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
echo "Connection Error:" . $e->getMessage();
}
}

public static function getConnection()
{
if(!self::$db)
{
new dbConn();
}
return self::$db;
}
}
$db = dbConn::getConnection();
echo "<b>Connection Successful</b>"."<br>";

?>


