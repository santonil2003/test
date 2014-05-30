<?php
class Config
{
    var $dbhost;
    var $dbuser;
    var $dbpass;
    var $dbname;

    function Config()
	{	
/*		$this->dbhost='localhost';
        $this->dbuser='identiki';
        $this->dbpass='id4$cTe';
        $this->dbname='identikid';*/
		$this->dbhost='localhost';
        $this->dbuser='identiki';
        $this->dbpass='id4$cTe';
        $this->dbname='test';
	}
}

class DbConnect
{
	var $cfg;
	var $conn;

	function DbConnect($cfg)
	{
		$this->cfg = $cfg;
	}

	function connectDb()
	{
		$this->conn = mysql_connect($this->cfg->dbhost,$this->cfg->dbuser,$this->cfg->dbpass);
		mysql_select_db($this->cfg->dbname,$this->conn) or die( 'Unable to select database:common MySQL');
	}

	function closeDb()
	{
		if(isset($this->conn))
		{
			@mysql_free_result($this->conn);
			@mysql_close($this->conn);
		}	
	}  
}


function linkme(){

  $cfg = new Config();
  $db = new DbConnect($cfg);
  $db->connectDb();
  
}
?>
