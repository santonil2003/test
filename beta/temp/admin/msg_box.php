<div id="blockBox" style="background-color:#ffffff;display:none;cursor:default;text-align:center"> 
  <br><form name="POSTING_FORM"><div style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:14px; color: #676767;" id="blockBoxContents"></div></form><br>
  <table border="0" width="100%" align="center"><tr align="center" ><td align="center">
  <table border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td align="center">
        <div id="closeButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button" style="cursor: pointer;" class="close" id="close" value="Close"/></div>
      </td>
      <td align="center">
        <div id="okButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button" style="cursor: pointer;" class="ok" id="ok" value="OK"/></div>
      </td>
      <td align="center">
        <div id="yesButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button" style="cursor: pointer;" class="yes" id="yes" value="Yes" /></div>
      </td>
      <td align="center">
        <div id="noButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="button" style="cursor: pointer;" class="no" id="no" value="No" /></div>
      <td>
    </tr>
   </table>
   </td></tr></table>
  <br>
</div>

<script type="text/javascript">

  var blockBox = '';
  
  $(document).ready(
    function(){      
      blockBox = $("#blockBox")[0];
      $('.close').click($.unblockUI);
      $('.ok').click($.unblockUI);
      $('.yes').click($.unblockUI);
      $('.no').click($.unblockUI);
    }
  );
  
  var msg = {
  
    width:325,
    close:false,
    ok:false,
    yes:false,
    no:false,
    
    load : function() {
  
      //$.blockUI(blockBox, { width: msg.width+'px' });
      
      $.blockUI({ message: blockBox, css: { width: msg.width+'px' } }); 
      $("#blockBoxContents").html('');
    
      for (var i = 0; i < msg.load.arguments.length; i++) {
        switch(msg.load.arguments[i]) {
          case 'close':msg.close=true;break;
          case 'ok':msg.ok=true;break;
          case 'yes':msg.yes=true;break;
          case 'no':msg.no=true;break;
        }
      } 
        
      if(msg.close==true)$("#closeButton").css("display", "inline");
      else $("#closeButton").css("display", "none");
      
      if(msg.ok==true)$("#okButton").css("display", "inline");
      else $("#okButton").css("display", "none");
    
      if(msg.yes==true)$("#yesButton").css("display", "inline");
      else $("#yesButton").css("display", "none");
      
      if(msg.no==true)$("#noButton").css("display", "inline");
      else $("#noButton").css("display", "none");

    }
    ,
    content: function(blockBoxHTML) {
      $("#blockBoxContents").html(blockBoxHTML);
    },
    
    click: function(button, action) { 
      $('.'+button).click(function(){ eval(action); });    
    }
  }
    
    
</script>