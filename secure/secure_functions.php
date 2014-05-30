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

	if($header)
		include "./secure_footer.php";

	exit();

}





?>
