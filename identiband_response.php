<?php
	$quantity = $_GET['quantity'];
	echo "document.getElementById('displaydiv').innerHTML = '';";
	
	for ($i=0; $i<5; $i++)
	{
		$bd = "banddesign".$i;
		$design = $_GET['design'.$i];
		if ($i >= $quantity)
			$design = "spacer_trans";
		echo "document.getElementById('".$bd."').innerHTML = '<img src=\"http://www.identikid.com.au/images/identibands/".$design.".gif\">';";
	}
?>
