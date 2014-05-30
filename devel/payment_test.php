<body onLoad="document.forms[0].submit();">
	<form action="secure.logiccommerce.com/services/Payment.asmx/Process HTTP/1.1" method="post">
		<input type="hidden" name="ContactName" value="<? echo $_POST["firstname"]." ".$_POST["surname"]; ?>">
		<input type="hidden" name="ContactEmail" value="<? echo $_POST["emailadd"];?>">
		<input type="hidden" name="InvoiceNumber" value="<? echo 1000+$id; ?>">
		<input type="hidden" name="PaymentAmount" value="1.00">
	</form>
</body>