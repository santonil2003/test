<?php
class EditDocument
{
	function execute()
	{
		require_once(SITE_DIR.'_classes/_entity/_Document.php');
		require_once(SITE_DIR.'_classes/_entity/_Userfile.php');
		if(is_uploaded_file($_FILES['filename']['tmp_name']))
		{		
			$uploaded=Userfile::uploadFile($_FILES['filename']['tmp_name'], $_FILES['filename']['name'], $_FILES['filename']['size'],$_FILES['filename']['type'],$_FILES['filename']['error'], PDFPATH, PDF);
			if($uploaded)
			{
				$pdf_file=addslashes($uploaded);
			}	
			else
			{
				trigger_error('File not uploaded', E_USER_NOTICE);
			}
		}
		else
		{
			$pdf_file = addslashes($_POST['pdf_file']);
		}	
		$doc = new Document($_POST['title'],$pdf_file,$_POST['type'], $_POST['doc_code'], $_POST['date_added'], $_POST['doc_id']);
		$doc->updateDoc();
		if(isset($_POST['companies']))
		{
			$company_array = array();
			for($i=0;$i<count($_POST['companies']);$i++)
			{
					$company_array[$i] = $_POST['companies'][$i];
			}
		}	
		$doc->setCompanies($company_array);
		return 1;
	}
}
?>
