<?php
class MemberLogin
{
	function execute()
	{
		if((!empty($_POST['username']))&&(!empty($_POST['password'])))
		{
			require_once(SITE_DIR.'_classes/_entity/_Employee.php');
			$emp = new Employee();
			$emp->EeId = $_POST['username'];
			$emp->password = $_POST['password'];
			if($emp->login())
			{
				$user = &$_SESSION['siteuser'];
				$user->type = MEMBER_USER;
				$user->id = $emp->EeId;
				$user->username = $emp->EeId;
				$user->firstName = $emp->firstName;
				$user->name = ucfirst(strtolower($emp->firstName)).' '.ucfirst(strtolower($emp->lastName));
				$user->last_login = $emp->last_login;
				$user->ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
				$user->company_name = $emp->erName;
				$user->company_id = $emp->getCompanyId();
				$_SESSION['siteuser']=&$user;
		
		
//echo 'COMPANY ID: '.$user->company_id.'<br>';		
				
				
			}
			else
			{
				trigger_error('Login failed', E_USER_NOTICE);
			}
		}
		else
		{
			trigger_error('You must enter both username and password', E_USER_NOTICE);
		}
		return 1;
	}
}
?>
