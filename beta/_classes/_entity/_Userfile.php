<?php
define('PDF', 'application/pdf');
define('JPG', 'image/jpg');

//$less_slashes = explode('/',$_SERVER['SCRIPT_FILENAME']) ;
//$abs_path_to_file='';
//foreach($less_slashes as $key=>$val)
//{
//	if($val=='admin') break;
//	$abs_path_to_file.= $val.'/';
//}
//$abs_path_to_file.= "C:\echidna\step\public_html\pdfdocs\";


function getFileTypeName($filetype)
{
	switch($filetpye)
	{
		case PDF:
			$file_msg = 'PDF';
			break;
		case JPG:
			$file_msg = 'JPG';
			break;
	}
	return $file_msg;		
}

class Userfile
{
	function uploadFile($userfile, $userfile_name, $userfile_size, $userfile_type, $userfile_error, $file_path, $file_type)
	{
		$upfile = $file_path.$userfile_name;
		if(!$userfile_error)
		{
			if(is_uploaded_file($userfile))
			{
				if((!$file_type)||($file_type&&$file_type==$userfile_type))
				{
					if(!move_uploaded_file($userfile, $upfile))
						trigger_error('Could not move file to destination directory ('.$upfile.')', E_USER_ERROR);
					else
					{
						chown($upfile, 'stepmgmt.stepmgmt');
						chmod($upfile, 777);
						
						$result = 1;
					}	
				}
				else
				{
					trigger_error('This file is not a '.getFileTypeName($file_type).'. It cannot be uploaded here.', E_USER_NOTICE);
				}
			}
			else
			{
				trigger_error('Possible file upload attack! Filename: '.$userfile_name, E_USER_ERROR);
			}
		}
		else
		{
			switch($userfile_error)
			{
				case 1:
					trigger_error('File exceeds maximum upload size', E_USER_NOTICE);
					break;
				case 2:
					trigger_error('File exceeds maximum upload size', E_USER_NOTICE);
					break;
				case 3:
					trigger_error('File only partially uploaded', E_USER_NOTICE);
					break;
				case 4:
					trigger_error('No file uploaded', E_USER_NOTICE);
					break;
			}
			
		}
		return $upfile;
	}

	function deleteFile($userfile_name)
	{
		unlink($userfile_name);
	}
	
	function fileExists($userfile_name)
	{
		return file_exists($userfile_name);
	}
	
	function returnFilename($userfile_name)
	{
		return basename($userfile_name);
	}	
}
?>