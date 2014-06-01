<?php

class DBHelper {

	public $krdb;

	function __construct($db_params){

		
		$this->krdb = new PDO(
		    'mysql:host='.$db_params['db_host'].';dbname='.$db_params['db_name'],
		    $db_params['db_user'],
		    $db_params['db_pass']);
		$this->krdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function insert_into($params){
		$sql_columns = '';
		$sql_column_binds = '';
		foreach(array_keys($params['executes']) as $column){
			$sql_columns .= $column.',';
			$sql_column_binds .= ':'.$column.',';
		}
		$sql_columns = substr($sql_columns,0,-1);
		$sql_column_binds = substr($sql_column_binds,0,-1);
		$sql = "INSERT INTO {$params['table']} ($sql_columns) VALUES ($sql_column_binds)";
        $stmt = $this->krdb->prepare ($sql);
        $stmt -> execute($params['executes']);
        $id = $this->krdb->lastInsertId(); 
        $stmt->closeCursor();
        unset($stmt);
        return $id;
	}

	public function update($params)
	{
		$sql_columns = '';
		foreach(array_keys($params['executes']) as $column){
			$sql_columns .= $column.' = :'.$column.",";
		}
		$where_columns = '';
		foreach($params['where'] as $column => $value){
			$where_columns .= $column." = '".$value."' and ";
		}
		$where_columns = substr($where_columns,0,-5);
		$sql_columns = substr($sql_columns,0,-1);
		$sql = "UPDATE {$params['table']} SET $sql_columns WHERE $where_columns";
        $stmt = $this->krdb->prepare ($sql);
        foreach($params['executes'] as $column => $value){
        	$stmt -> bindParam(':'.$column, $value);
        }
        $stmt -> execute();
        $stmt->closeCursor();
    	unset($stmt);

	}


}