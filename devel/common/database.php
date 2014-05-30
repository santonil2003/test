<?

//function db_connect()
//{
//	
//	$link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
//	if (!$link) {
//		report_error('Could not connect: ' . mysql_error());
//	}
//	mysql_select_db(DB_NAME) or report_error("could not select database");
//}


function db_escape_string($string)
{
	//echo "X".$string."Y";
	assert(is_string($string) or is_numeric($string));
	return str_replace("'", "''", $string);
}


function db_query($sql)
{
	assert(is_string($sql));
	$result = mysql_query($sql) or report_error($sql . "\n" . mysql_error());
	return $result;
}

function db_num_rows($result)
{
	assert(is_resource($result));
	
	return mysql_num_rows($result);
}

function db_get_field($sql, &$field)
{
	$result = db_query($sql);
	if($result == true)
	{
		if(db_num_rows($result) == 1)
		{
			list($field) = db_fetch_array($result);
			return true;
		}
		else 
		{
			$field = null;
			return true;
		}
	}
	else 
	{
		return false;
	}
}

function db_insert($table, $record, &$id)
{
	assert(is_string($table));
	assert(is_array($record));
	
	$keys = "";
	$values = "";
	foreach($record as $key => $value)
	{
		if(!empty($keys))
		{
			$keys .= ", ";
			$values .= ", ";

		}
		$pos = strpos($key, "*");
		if(preg_match("/^\*(\w*)$/", $key, $regs))
		{
			$keys .= " {$regs[1]}";
			$values .= $value;
		}
		else 
		{
			$keys .= " {$key}";
			$values .= "'" . db_escape_string($value) . "'";
		}
		
		
		
	}
	
	$sql = "INSERT into {$table} ({$keys}) VALUES ({$values})";

//	debug_showvar($sql);
	$result = db_query($sql);	
	$id = mysql_insert_id();
	return $result;
}

function db_fetch_array($result)
{
	assert(is_resource($result));
	return mysql_fetch_array($result);
}

function db_update($table, $record, $where)
{
	assert(is_string($table));
	assert(is_array($record));
	assert(is_string($where));
	
	$sql = "";
	foreach ($record as $key => $value)
	{
		if(strlen($sql) > 0)
		{
			$sql .= ", ";
		}
		if(preg_match("/^\*(\w*)$/", $key, $regs))
		{
			$sql .= "{$regs[1]}=" . db_escape_string($value);
		}
		else 
		{
			$sql .= " {$key}='" . db_escape_string($value) . "'";
		}
	}
	$sql = "UPDATE {$table} SET {$sql} WHERE {$where}";
//	debug_showvar($sql);
	$result = db_query($sql);
	if($result == true)
	{
		return true;
	}
	else 
	{
		report_error('error inserting data\n' . $sql);
		return false;
	}
}

function db_begin()
{
	db_query('BEGIN');
}

function db_commit()
{
	db_query('COMMIT');
}

function db_rollback()
{
	db_query('ROLLBACK');
}

?>
