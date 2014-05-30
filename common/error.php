<?

function error_msg($type, $message)
{

	?>
	<h1><?= htmlspecialchars($type); ?></h1>
	<p><?= $message; ?></p>
	<?
	
	
}


function assert_handler($file, $line, $code) 
{
	report_error("
Assertion Failed:
File {$file}
Line {$line}
Code {$code}
");
	
}

function debug_showvar($variable)
{
	
	?>
	<table cellspacing="1" cellpadding="1" style="border: 2px red solid">
		<tr>
			<td><pre>
			<?
				if(is_array($variable))
				{
					print_r($variable);
				}
				else 
				{
					print($variable);
				}
			?>
			</td>
		</tr>
	</table>
	<?
}

function report_error($message)
{
	$output = "message: " . $message . "\n";
	$output .= "\n";
   	$output .= "Backtrace:\n";
   	$backtrace = debug_backtrace();
	foreach ($backtrace as $bt) {
       $args = '';
       foreach ($bt['args'] as $a) {
           if (!empty($args)) {
               $args .= ', ';
           }
           switch (gettype($a)) {
           case 'integer':
           case 'double':
               $args .= $a;
               break;
           case 'string':
               $a = htmlspecialchars($a);
               $args .= "\"$a\"";
               break;
           case 'array':
               $args .= 'Array('.count($a).')';
               break;
           case 'object':
               $args .= 'Object('.get_class($a).')';
               break;
           case 'resource':
               $args .= 'Resource('.strstr($a, '#').')';
               break;
           case 'boolean':
               $args .= $a ? 'True' : 'False';
               break;
           case 'NULL':
               $args .= 'Null';
               break;
           default:
               $args .= 'Unknown';
           }
       }
       $output .= "\n\n";
       $output .= "file: {$bt['line']} - {$bt['file']}\n";
       $output .= "call: {$bt['class']}{$bt['type']}{$bt['function']}($args)\n";
   }
   	$output .= "\n";
	$output .= "_GET\n".debug_capture_print_r($_GET)."\n\n";
	$output .= "_POST\n".debug_capture_print_r($_POST)."\n\n";
	$output .= "_SESSION\n".debug_capture_print_r($_SESSION)."\n\n";
	$output .= "_COOKIE\n".debug_capture_print_r($_COOKIE)."\n\n";

	// development server?
	if( DEV_SERVER == TRUE )
	{
		debug_showvar($output);
	}
	else
	{
		// no? send an email
		$path = var_export(debug_backtrace(), TRUE);
		email(ADMIN_EMAIL, "Website Error: " . $_SERVER['HTTP_HOST'], $output . "\n\n" . $path);
	}
}

function display_error($message, $report_error = false)
{
	?><p style="color: red"><?= htmlspecialchars($message); ?></p><?
	if($report_error == true)
	{
		report_error($message);
		?><p>This error has been reported to the Administrator.</p><?
	}
	
}

function display_errors($left='<p>', $right='</p>')
{
	$error_code = param('error');
	$error_message = "";
	if(empty($error_code) == false)
	{
		// system code
		if(substr($error_code, 0, 1) == 'a')
		{
			$sql = "SELECT error_message FROM error WHERE error_number='" . db_escape_string($error_code) . "'";
			$result = db_query($sql);
			if($result == true)
			{
				list($error_message) = db_fetch_array($result);
				report_error("system error: " . $error_message);
			}
			else 
			{
				report_error('error retrieving system error code');	
			}
			
		}
		else 
		{
			$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
			$sql = "SELECT error_message FROM error where error_number='" . db_escape_string($error_code) . "' AND error_page='" . db_escape_string($path_parts['basename'])  ."'";
			$result = db_query($sql);
			if($result == true)
			{
				list($error_message) = db_fetch_array($result);
			}
			else 
			{
				report_error('error retrieving error code');	
			}
		}
	}

	if(empty($error_message) == false)
	{
		if(preg_match("/{{([A-Z0-9_-]*)}}/", $error_message, $matches) == true)
		{
			for($match_no=1; $match_no<sizeof($matches); $match_no++)
			{
				eval('$match = ' .$matches[$match_no]. ';');
				$error_message = str_replace('{{'.$matches[$match_no].'}}', $match, $error_message);
			}
		}
		echo $left.'<span class="error_message">'.$error_message.'</span>'.$right;
	}
}

function display_msgs($left='<p>', $right='</p>')
{
	$error_code = param('msg');
	$message = "";
	if(empty($error_code) == false)
	{
		// system code
		if(substr($error_code, 0, 1) == 'a')
		{
			$sql = "SELECT message FROM message WHERE message_number='" . db_escape_string($error_code) . "'";
			$result = db_query($sql);
			if($result == true)
			{
				list($message) = db_fetch_array($result);
			}
			else 
			{
				report_error('error retrieving system message');	
			}
			
		}
		else 
		{
			$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);
			$sql = "SELECT message FROM message WHERE message_number='" . db_escape_string($error_code) . "' AND message_page='" . db_escape_string($path_parts['basename'])  ."'";
			$result = db_query($sql);
			if($result == true)
			{
				list($message) = db_fetch_array($result);
			}
			else 
			{
				report_error('error retrieving message');	
			}
		}
	}
	if(empty($message) == false)
	{
		if(preg_match("/{{([A-Z0-9_-]*)}}/", $message, $matches) == true)
		{
			for($match_no=1; $match_no<sizeof($matches); $match_no++)
			{
				eval('$match = ' .$matches[$match_no]. ';');
				$message = str_replace('{{'.$matches[$match_no].'}}', $match, $message);
			}
		}
		echo $left . '<span class="message">' . $message . '</span>' . $right;
	}
}

function debug_capture_print_r($data) 
{ 
    ob_start(); 
    print_r($data); 

    $result = ob_get_contents(); 

    ob_end_clean(); 

    return $result; 
} 
?>