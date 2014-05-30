<?

function mailer_test($to, $subject, $message)
{
	debug_showvar("{$to}\n\n{$subject}\n\n{$message}");	
}


/**
 * alias for mail(), to be used in the future with different options.
 *
 * @param string $to
 * @param string $subject
 * @param string $message
 * @param string $headers
 */
function email($to, $subject, $message, $headers='')
{
	assert(is_string($to));
	assert(is_string($subject));
	assert(is_string($message));
	
	if(DEVEL == true)
	{
		report_error('email sent:
			to: ' . $to . '
			subject: ' . $subject . '
			headers: ' . $headers . '
			message: ' . $message);
		return true;
	
	}
	else 
	{
		if($headers == '')
		{
			$success = mail($to, $subject, $message);
		}
		else 
		{
			$success = mail($to, $subject, $message, $headers);
		}
		if($success == true)
		{
			return true;
		}
		else 
		{
			report_error("there was an error sending an email
				to: {$to}
				subject: {$subject}
				headers: {$headers}
				message: {$message}
				
				" . print_r($mail->errors, true));
			return false;
		}
	}
	
}


?>