<?php
class User
{
	var $type;
	var $username;
	var $first_name;
	var $name;
	var $id;
	var $last_login;
	var $ip;
	var $company_name;
	var $company_id;
		
	function User($type, $username, $first_name, $name, $id, $last_login, $company_name, $company_id)
	{
		$this->type = $type;
		$this->username = $username;
		$this->first_name = $first_name;
		$this->name = $name;
		$this->id = $id;
		$this->last_login = $last_login;
		$this->ip = $ip;
		$this->company_name = $company_name;	
		$this->company_id = $company_id;	
	}
}
?>