//--------------------------------------------------------------------
// Document fully loaded event
//--------------------------------------------------------------------

$(document).ready(
  function(){
   validateBox = $('#validate')[0];
	$('.ok').click($.unblockUI);
  }
);


//--------------------------------------------------------------------
// Validate form data 
//--------------------------------------------------------------------

var validateBox;
var faults;

function validate(form){

  var formObj

  if(typeof(form) == 'object') {
    formObj = form; 
  } else {
    formObj = eval('document.'+form);
  }
  
  faults = new Array;
  
  // Iterate through required fields  
  var numFaults = 0;     
  for (var i = 1; i < validate.arguments.length; i++) {
    if(formObj.elements[validate.arguments[i]].value=='' ) {
      faults[numFaults] = validate.arguments[i]; 
      numFaults++;
    }
  }     
  
  if(faults.length > 0) {
    $.blockUI(validateBox, { width: '325px' });
    var fields = faults.length>1?" fields.":" field.";
    var faultsTxt = 'Please complete the';
    for (var i = 0; i < faults.length; i++) {
      faultName = faults[i].replace(/_+/,"&nbsp;");
      faultName = faultName.replace(/^./, faultName.match(/^./)[0].toUpperCase());
      faultsTxt+= " '"+faultName+"' ";
      if(i<(faults.length-2)) {
        faultsTxt+= ',';
      } else if(i<(faults.length-1)) {
        faultsTxt+= '&amp;';
      }
      //faultsTxt+= i<(faults.length-1)?'&amp;':'';
    }
    faultsTxt+=fields
    $("#validateFaults").html(faultsTxt);
    return false;
  } else {
    return true;
  }      
  
}