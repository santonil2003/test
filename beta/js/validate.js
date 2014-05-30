//--------------------------------------------------------------------
// Document fully loaded event
//--------------------------------------------------------------------

jQuery(document).ready(
  function(){
   validateBox = jQuery('#validate')[0];
	jQuery('.ok').click(jQuery.unblockUI);
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
    jQuery.blockUI(validateBox, { width: '325px' });
    var fields = faults.length>1?" fields.":" field.";
    var faultsTxt = 'Please complete the';
    for (var i = 0; i < faults.length; i++) {
      faultName = faults[i].replace(/^./, faults[i].match(/^./)[0].toUpperCase());
      faultsTxt+= " '"+faultName+"' ";
      faultsTxt+= i<(faults.length-1)?'&amp;':'';
    }
    faultsTxt+=fields
    jQuery("#validateFaults").html(faultsTxt);
    return false;
  } else {
    return true;
  }      
  
}