// JavaScript Document
function getXMLHTTPRequest()
{
	var req = false;
	try
	{
		req = new XMLHttpRequest();
	}
	catch(err1)
	{
		try
		{
			req = new ActiveXObject("Msxm12.XMLHTTP");
			// some versions of IE
		}
		catch(err2)
		{
			try
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			// some versions of IE
			}
			catch(err3)
			{
				req = false;
			}
		}
	}
	return req;
}
		