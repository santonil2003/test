<div id="blockBox" style="background-color:#ffffff;display:none;cursor:default;text-align:center"> 
  <br><div style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size:14px; color: #676767;" id="blockBoxContents"></div><br>
  <table border="0" width="100%" align="center"><tr align="center" ><td align="center">
  <table border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td align="center">
        <div id="okButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_ok_o.gif" alt="OK" style="cursor: pointer;" class="ok"id="ok" value="OK" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ok','','../images/nav/n_ok_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="yesButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_yes_o.gif" alt="YES" style="cursor: pointer;" class="yes"id="yes" value="YES" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('yes','','../images/nav/n_yes_x.gif',1)"/></div>
      </td>
      <td align="center">
        <div id="noButton" style="background-color:#ffffff;display:none;cursor:default;"><input type="image" src="../images/nav/n_no_o.gif" alt="NO" style="cursor: pointer;" class="no"id="no" value="NO" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('no','','../images/nav/n_no_x.gif',1)"/></div>
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
      $('.ok').click($.unblockUI);
      $('.yes').click($.unblockUI);
      $('.no').click($.unblockUI);
    }
  );
  
  function msg_blockUI(box_width) {
     $.blockUI(blockBox, { width: box_width+'px' });
  }
  
  var msg_box = {
  
    width:325,
    ok:false,
    yes:false,
    no:false,
    content:'',
    
    load: function() {
  
      $.blockUI(blockBox, { width: this.width+'px' });
      
      $("#blockBoxContents").html(content);
    
      for (var i = 0; i < this.load.arguments.length; i++) {
        switch(this.load.arguments[i]) {
          case 'ok':this.ok=true;break;
          case 'yes':this.yes=true;break;
          case 'no':this.no=true;break;
        }
      }   
     
      if(this.ok==true)$("#okButton").css("display", "inline");
      else $("#okButton").css("display", "none");
    
      if(this.yes==true)$("#yesButton").css("display", "inline");
      else $("#yesButton").css("display", "none");
      
      if(this.no==true)$("#noButton").css("display", "inline");
      else $("#noButton").css("display", "none");

    }
    ,
    
    click:function(button, action) { 
      $('.'+button).click(function(){ eval(action); });    
    }
  }
    
    
</script>