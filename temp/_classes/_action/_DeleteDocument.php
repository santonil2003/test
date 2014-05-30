<?php
class DeleteDocument
{
	function execute()
	{
		$doc_id = (isset($_GET['doc_id'])?$_GET['doc_id']:$_POST['doc_id']);
		if($doc_id)
		{
			require_once(SITE_DIR.'_classes/_entity/_Document.php');
			require_once(SITE_DIR.'_classes/_entity/_Userfile.php');		
			$doc = new Document();
			$doc->id = $doc_id;
			$doc->getByID();
			$filename = $doc->pdf_file;
			$deleted = Userfile::deleteFile($filename);
			$doc->deleteDoc();
		}	
		else
		{
			trigger_error('Delete Document is missing doc_id', E_USER_ERROR);
		}
	}
}
?>
