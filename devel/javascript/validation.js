// JavaScript Document
function submitForm(form) {
	if (validateForm(form) == true) {
		form.submit();
	}
}
function validateLength(input, length, label) {
	if (input.value.length < length) {
		alert("The " + label + " field must be at least " + length + " characters");
		input.focus();
		return false;
	} else {
		return true;
	}
}
function validateFilled(input, label) {
	if (input.value.length == 0) {
		alert("Please fill in your " + label);
		input.focus();
		return false;
	} else {
		return true;
	}
}

function validateCheckBoxArray(inputArray, label)
{
	var found = false;
	var other = true;
	for (i=0; i<inputArray.length;i++)
	{
		if (inputArray[i].checked)
		{
			found = true;
			if (inputArray[i].value=='Other')		//this applies to search forms 'other' checkbox & its associated textarea
			{
				var el = document.getElementById(inputArray[i].name.substr(0,inputArray[i].name.length-2)+"_note");
				if(el.value.length<=0)
				{
					alert('Please specify other '+label);
					other = false;						
				}
			}
		}	
	}
	if(!found)alert('Please select at least one '+label);
	if(!other)found=false;
	return found;	
}

function validateRadioArray(inputArray, label)
{
	var found = false;
	for (i=0; i<inputArray.length;i++)
	{
		if (inputArray[i].checked) found = true;
	}
	if(!found)alert('Please select a '+label);
	return found;	
}

function validatePasswords(input, confirmInput)	//compares 2 passwords 
{
	if (input.value == confirmInput.value)		//if they do match, check that the password is long enough
	{
		return validateLength(input, 6, "Password");
	}
	else										//otherwise, if the 2 aren't the same as each other... 
	{
		alert("The passwords do not match. Please reenter and try again" );
		input.focus();
		return false;
	}
}

function validateSelected(input, label) {
	if (input.options[input.selectedIndex].value == 0) {
		alert("Please select your " + label);
		input.focus();
		return false
	}
	return true;
}

function validateNumber(input, label, limit) {
	// if input number is an integer and is of limit
	if (isInteger(input.value) && ((limit > 0) ? (input.value.length == limit) : true)) {
		// number is valid
		return true;
	} else {
		alert("You have entered an invalid " + label);
		input.focus();
		return false;
	}
}

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function validatePhone(input, label) {
	if (input.value.length == 0) {
		return true;
	} else {
		var strPhone = input.value;
		// non-digit characters which are allowed in phone numbers
		var phoneNumberDelimiters = "()- ";
		// characters which are allowed in international phone numbers
		// (a leading + is OK)
		var validWorldPhoneChars = phoneNumberDelimiters + "+";
		// Minimum no of digits in a phone no.
		var minDigitsInIPhoneNumber = 8;
		s=stripCharsInBag(strPhone,validWorldPhoneChars);
		if (isInteger(s) && s.length >= minDigitsInIPhoneNumber) { 
			return true;
		} else {
			alert("You have entered an invalid " + label);
			return false;
		}
	}
}



function validateEmail (input, label) {
	var emailStr = input.value;
	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom=validChars + '+'
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
	var matchArray=emailStr.match(emailPat)
	if (matchArray==null) {
		alert("You have entered an invalid " + label + " (check @ and .'s)");
		input.focus();
		return false
	}
	var user=matchArray[1]
	var domain=matchArray[2]
	if (user.match(userPat)==null) {
		alert("You have entered an invalid " + label + ". The username doesn't seem to be valid.")
		input.focus();
	    return false
	}
	var IPArray=domain.match(ipDomainPat)
	if (IPArray!=null) {
		  for (var i=1;i<=4;i++) {
		    if (IPArray[i]>255) {
		        alert("You have entered an invalid " + label + ". Destination IP address is invalid!")
				input.focus();
				return false
		    }
	    }
	    return true
	}
	var domainArray=domain.match(domainPat)
	if (domainArray==null) {
		alert("You have entered an invalid " + label + ". The domain name doesn't seem to be valid.")
		input.focus();
	    return false
	}
	var atomPat=new RegExp(atom,"g")
	var domArr=domain.match(atomPat)
	var len=domArr.length
	if (domArr[domArr.length-1].length<2 ||
	    domArr[domArr.length-1].length>3) {
	   alert("You have entered an invalid " + label + ". The address must end in a three-letter domain, or two letter country.")
		input.focus();
	   return false
	}
	if (len<2) {
	   var errStr="You have entered an invalid " + label + ". This address is missing a hostname!"
	   alert(errStr)
		input.focus();
	   return false
	}
	return true;
}
