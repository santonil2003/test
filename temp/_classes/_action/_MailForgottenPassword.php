<?php
class MailForgottenPassword()
{
	function execute()
	{
		if((!empty($_POST['id']))
		{
			require_once(SITE_DIR.'_classes/_entity/_Administrator.php');
			$admin = new Administrator();
			$admin->id = $_POST['id'];

			if($admin->findById())
			{
				$email = $admin->$contact1_email;
				$subject = "Forgotten Password for STeP Administrator";
				$message = "Your password is $admin->password";
				mail($email, $subject, $message, "From: info@stepmanagement.com.au");								
			}
			else
			{
				trigger_error('Agency ID not found', E_USER_NOTICE);
			}
		}
		else
		{
			trigger_error('You must enter agency id', E_USER_NOTICE);
		}
		return 1;
	}
}
?>
