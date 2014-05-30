// JavaScript Document
function callAHAH(url, pageElement, callMessage) {
	document.getElementById(pageElement).innerHTML = callMessage;
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
	req.onreadystatechange = function() {responseAHAH(pageElement);};
	var myRandom=parseInt(Math.random()*99999999);
	var quantity = document.form1.quantity.value;
	var design0 = document.form1.design0.value;
	var design1 = document.form1.design1.value;
	var design2 = document.form1.design2.value;
	var design3 = document.form1.design3.value;
	var design4 = document.form1.design4.value;
	req.open("GET",url + "&rand=" + myRandom + "&quantity=" + quantity +"&design0=" + design0 + "&design1=" + design1 + "&design2=" + design2
	+ "&design3=" + design3 + "&design4=" + design4,true);
	req.send(null);
}

function responseAHAH(pageElement) {
	var output = '';
	if(req.readyState == 4) {
		if(req.status == 200) {
			//output = req.responseText;
			//document.getElementById(pageElement).innerHTML = output;
			eval(req.responseText);
		}
		else {
			alert("An error has occured: " + req.statusText);
		}
	}
}
