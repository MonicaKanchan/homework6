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
echo "<b>Connection Successful</b>"."<br>";
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
//echo "<b>Connection Successful</b>"."<br>";

class Collection
{
static public function create()
{
$model=new static::$modelName;
return$model;
}
static public function findAll()
{
$db=dbConn::getConnection();
$tableName=get_called_class();
$sql='SELECT * FROM' .$tableName;
$statement = $db->prepare($sql);
$statement->execute();
$class = static::$modelName;
$statement->setFetchMode(PDO::FETCH_CLASS,$class);
$recordsSet= $statement->fetchAll();
return $recordsSet;
}

static public function findOne($id)
{
$db=dbConn::getConnection();
$tableName=get_called_class();
$sql='SELECT * FROM '.$tableName. 'WHERE id=' .$id;
$statement=$db->prepare($sql);
$statement->execute();
$class=static::$modelName;
$statement->setFetchMode(PDO::FETCH_CLASS, $class);
$recordsSet= $statement->fetchAll();
return $recordsSet[0];
}
}

class accounts extends Collection
{
protected static $modelName = 'account';
}

class todos extends Collection
{
protected static $modelName = 'todo';
}


?>
