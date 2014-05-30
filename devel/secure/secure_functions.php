<?PHP

/**************
*
*	FUNCTIONS
*
**************/

function errorMsg()
{
	include_once "./secure_header.php";
	?>
	<p>You have accessed this page incorrectly, please <a href="http://www.identikid.com.au" class="type1" target="_blank" onClick="window.close();">click here</a> to return to the identiKid website.</p>
	<p>If you beleive this is an error, then please contact <a href="mailto:info@identikid.com.au" class="type1">info@identikid.com.au</a>.</p>
	<?
	include_once "./secure_footer.php";
}

function secureErrorMsg($msg, $header=false)
{
	
	if($header)
		include "./secure_header.php";
	
	?>
	<p>There was an issue submitting your payment.</p>
	<p><?=$msg?></p>
	<p>Please report this error to IdenitKid</p>
	<p><a href="mailto:info@identikid.com.au">info@identikid.com.au</a></p>
	<?
	
 	report_error($msg);
	
	if($header)
		include "./secure_footer.php";

	exit();

}

/* function report_error($message)
{
	$output = date("d/m/Y H:i:s") . "\n\n";
	$output .= "message: " . $message . "\n";
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
    $output .= "\n\n\n";
   
    $output .= "GET: \n\n " . print_r($_GET, true) . "\n\nPOST: \n\n" . print_r($_POST, true) . "\n\n\nSESSION: \n\n" . print_r($_SESSION, true). "\n\n\COOKIE: \n\n" . print_r($_COOKIE, true);
	//$path = var_export(debug_backtrace(), TRUE);
	mail(EMAIL_ADMIN,"Identikid Secure Error",$output,"");
	
} */




?>
