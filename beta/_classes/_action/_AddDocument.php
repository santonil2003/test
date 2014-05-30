<?php
class AddDocument
{
	function execute()
	{
		require_once(SITE_DIR.'_classes/_entity/_Document.php');
		require_once(SITE_DIR.'_classes/_entity/_Userfile.php');		
		$uploaded=Userfile::uploadFile($_FILES['filename']['tmp_name'], $_FILES['filename']['name'], $_FILES['filename']['size'],$_FILES['filename']['type'],$_FILES['filename']['error'], PDFPATH, PDF);
		if($uploaded)
		{
			$uploaded=addslashes($uploaded);
			$dte = getdate();
			$dt = $dte[year] . "-" . str_pad($dte[mon], 2, "0", STR_PAD_LEFT) . "-" . str_pad($dte[mday], 2, "0", STR_PAD_LEFT);
			$doc = new Document($_POST['title'],$uploaded,$_POST['type'], $_POST['doc_code'], $dt, 0);//,$_POST['companies[]']);
			$doc->addDoc();
			if(isset($_POST['companies']))
			{
				$company_array = array();
				for($i=0;$i<count($_POST['companies']);$i++)
				{
					$company_array[$i] = $_POST['companies'][$i];
				}
			}
			$doc->setCompanies($company_array);
		}
		else
		{
			trigger_error('File not uploaded', E_USER_NOTICE);
		}
		return 1;
	}
}
?>
