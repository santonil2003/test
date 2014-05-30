<?
function addFont($type){
?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<?
		if($type==1){
		?>
		<tr>
			<td><input type="radio" name="font" value="1" checked onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
			<td><img src="../images/f1.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="5" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
			<td><img src="../images/f2.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="4" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
			<td><img src="../images/f3.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="radio" name="font" value="3" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
			<td><img src="../images/f4.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="2" onClick="if(document.forms[0].split){ document.forms[0].split.checked=false; document.forms[0].split.disabled=true; }"></td>
			<td><img src="../images/f5.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="6" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
			<td><img src="../images/f6.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<?
		}else if($type==3 || (int)$type == 21 ){
		?>
		<tr>
			<td><input type="radio" name="font" value="1" checked></td>
			<td><img src="../images/f1.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="4"></td>
			<td><img src="../images/f3.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="3"></td>
			<td><img src="../images/f4.gif" border="0"></td>
		</tr><?
		}else if($type==9){
		?>
		<tr>
			<td><input type="radio" name="font" value="1" checked></td>
			<td><img src="../images/f1.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="3"></td>
			<td><img src="../images/f4.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="font" value="6"></td>
			<td><img src="../images/f6.gif" border="0"></td>
		</tr><?
		}
		elseif($type==2 || $type==19){
			?>
			<tr>
				<td><input type="radio" name="font" value="1" checked onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f1.gif" border="0"></td>
				<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
				<td><input type="radio" name="font" value="5" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f2.gif" border="0"></td>
				<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
				<td><input type="radio" name="font" value="4" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f3.gif" border="0"></td>
			</tr>
			<tr>
				<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
			</tr>
			<tr>
				<td><input type="radio" name="font" value="3" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f4.gif" border="0"></td>
				<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
				<td><input type="radio" name="font" value="2" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f5.gif" border="0"></td>
				<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
				<td><input type="radio" name="font" value="6" onClick="if(document.forms[0].split){ document.forms[0].split.disabled=false; }"></td>
				<td><img src="../images/f6.gif" border="0"></td>
			</tr>
			<tr>
				<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
			</tr>
			<?
		}
		elseif($type==20)
		{
			?>
			<tr>
				<td><input type="radio" name="font" value="3" checked></td>
				<td><img src="../images/f3.gif" border="0"></td>
				<td colspan="6"><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			</tr><?
			
			
		}
?>
	</table>
<?
}


function addFontShared($packNum){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="radio" name="<?=$packNum;?>font" value="1" checked onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.disabled=false; }"></td>
			<td><img src="../images/f1.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="<?=$packNum;?>font" value="5" onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.disabled=false; }"></td>
			<td><img src="../images/f2.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="<?=$packNum;?>font" value="4" onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.disabled=false; }"></td>
			<td><img src="../images/f3.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="radio" name="<?=$packNum;?>font" value="3" onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.disabled=false; }"></td>
			<td><img src="../images/f4.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="<?=$packNum;?>font" value="2" onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.checked=false; document.forms[0].<?=$packNum;?>split.disabled=true; }"></td>
			<td><img src="../images/f5.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="5" border="0"></td>
			<td><input type="radio" name="<?=$packNum;?>font" value="6" onClick="if(document.forms[0].<?=$packNum;?>split){ document.forms[0].<?=$packNum;?>split.disabled=false; }"></td>
			<td><img src="../images/f6.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
	</table>
	<?
}

function addPictureItags(){
?>
	<!-- The following represents the old checkbox Admin IdentiTag ordering process. -->
	<!-- Where it is not possible to order more than one of each IdentiTag and have the discount apply -->
	<!-- THE START OF THE OLD CODE -->
	<!-- <table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="pic1" value="A" onClick="changeITagList(1);"></td>
			<td><img src="../images/pc1.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic2" value="C" onClick="changeITagList(2);"></td>
			<td><img src="../images/pc28.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic3" value="H" onClick="changeITagList(3);"></td>
			<td><img src="../images/pc7.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic4" value="M" onClick="changeITagList(4);"></td>
			<td><img src="../images/pc12.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic5" value="N" onClick="changeITagList(5);"></td>
			<td><img src="../images/pc13.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic6" value="Q" onClick="changeITagList(6);"></td>
			<td><img src="../images/pc16.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic7" value="R" onClick="changeITagList(7);"></td>
			<td><img src="../images/pc17.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="pic8" value="S" onClick="changeITagList(8);"></td>
			<td><img src="../images/pc18.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic9" value="T" onClick="changeITagList(9);"></td>
			<td><img src="../images/pc19.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic10" value="U" onClick="changeITagList(10);"></td>
			<td><img src="../images/pc20.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic11" value="V" onClick="changeITagList(11);"></td>
			<td><img src="../images/pc21.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic12" value="W" onClick="changeITagList(12);"></td>
			<td><img src="../images/pc22.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic13" value="X" onClick="changeITagList(13);"></td>
			<td><img src="../images/pc23.gif" border="0"></td>
			<td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
			<td><input type="checkbox" name="pic14" value="Y" onClick="changeITagList(14);"></td>
			<td><img src="../images/pc24.gif" border="0"></td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
	</table> -->
	<!-- THE END OF THE OLD CODE -->
	
<table border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="8"><input type="button" name="ClearSelection" value="clear" onClick="JavaScript: ClearIdentiTagSelection();"></td>
  </tr>
  <tr> 
    <td colspan="8"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td colspan="8"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="admintext"><strong>IdentiTag #1</strong></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="admintext"><strong>IdentiTag #2</strong></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="admintext"><strong>IdentiTag #3</strong></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="admintext"><strong>IdentiTag #4</strong></td>
  </tr>
  <tr> 
    <td colspan="8"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td align="center" height="60"><img name="Tag1" src="../images/spacer_trans.gif" border="0"></td>
    <td>&nbsp;</td>
    <td align="center" height="60"><img name="Tag2" src="../images/spacer_trans.gif" border="0"></td>
    <td>&nbsp;</td>
    <td align="center" height="60"><img name="Tag3" src="../images/spacer_trans.gif" border="0"></td>
    <td>&nbsp;</td>
    <td align="center" height="60"><img name="Tag4" src="../images/spacer_trans.gif" border="0"></td>
  </tr>
  <tr> 
    <td colspan="8"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td> <select name="IdentiTag1" onChange="JavaScript: UpdateIdentiTagImage(1);">
        <option value="none" selected>[None]</option>
        <option value="A">Sun</option>
        <option value="S">Shark</option>
        <option value="C">Frangipani</option>
        <option value="T">Train</option>
        <option value="H">Butterfly</option>
        <option value="U">Ballerina</option>
        <option value="M">Dinosaur</option>
        <option value="V">Motorbike</option>
        <option value="N">Fairy</option>
        <option value="W">Horse</option>
        <option value="Q">Mermaid</option>
        <option value="X">Skull</option>
        <option value="R">Truck</option>
        <option value="Y">Surfer</option>
        <option value="C1">Frog</option>
        <option value="D1">Surfer Girl</option>
        <option value="Z">Pirate</option>
        <option value="P">Plane</option>
        <option value="E">Loveheart</option>
        <option value="A1">Cow</option>
        <option value="G1">Bear</option>
        <option value="H1">Pig</option>
        <option value="I1">Cat</option>
        <option value="J1">Spider</option>
		<option value="I">UFO</option>
		<option value="J">Car</option>
		<option value="F1">Rocket</option>
		<option value="E1">Bee</option>
		<option value="U2">Purple Ballerina</option>
		<option value="K1">Dog</option>
		<option value="L1">Little Girl</option>
		<option value="M1">Medi Alert</option>
		<option value="N1">Star</option>
      </select> </td>
    <td>&nbsp;</td>
    <td> <select name="IdentiTag2" onChange="JavaScript: UpdateIdentiTagImage(2);">
        <option value="none" selected>[None]</option>
        <option value="A">Sun</option>
        <option value="S">Shark</option>
        <option value="C">Frangipani</option>
        <option value="T">Train</option>
        <option value="H">Butterfly</option>
        <option value="U">Ballerina</option>
        <option value="M">Dinosaur</option>
        <option value="V">Motorbike</option>
        <option value="N">Fairy</option>
        <option value="W">Horse</option>
        <option value="Q">Mermaid</option>
        <option value="X">Skull</option>
        <option value="R">Truck</option>
        <option value="Y">Surfer</option>
        <option value="C1">Frog</option>
        <option value="D1">Surfer Girl</option>
        <option value="Z">Pirate</option>
        <option value="P">Plane</option>
        <option value="E">Loveheart</option>
        <option value="A1">Cow</option>
        <option value="G1">Bear</option>
        <option value="H1">Pig</option>
        <option value="I1">Cat</option>
        <option value="J1">Spider</option>
		<option value="I">UFO</option>
		<option value="J">Car</option>
		<option value="F1">Rocket</option>
		<option value="E1">Bee</option>
		<option value="U2">Purple Ballerina</option>
		<option value="K1">Dog</option>
		<option value="L1">Little Girl</option>
		<option value="M1">Medi Alert</option>
		<option value="N1">Star</option>
      </select> </td>
    <td>&nbsp;</td>
    <td> <select name="IdentiTag3" onChange="JavaScript: UpdateIdentiTagImage(3);">
        <option value="none" selected>[None]</option>
        <option value="A">Sun</option>
        <option value="S">Shark</option>
        <option value="C">Frangipani</option>
        <option value="T">Train</option>
        <option value="H">Butterfly</option>
        <option value="U">Ballerina</option>
        <option value="M">Dinosaur</option>
        <option value="V">Motorbike</option>
        <option value="N">Fairy</option>
        <option value="W">Horse</option>
        <option value="Q">Mermaid</option>
        <option value="X">Skull</option>
        <option value="R">Truck</option>
        <option value="Y">Surfer</option>
        <option value="C1">Frog</option>
        <option value="D1">Surfer Girl</option>
        <option value="Z">Pirate</option>
        <option value="P">Plane</option>
        <option value="E">Loveheart</option>
        <option value="A1">Cow</option>
        <option value="G1">Bear</option>
        <option value="H1">Pig</option>
        <option value="I1">Cat</option>
        <option value="J1">Spider</option>
		<option value="I">UFO</option>
		<option value="J">Car</option>
		<option value="F1">Rocket</option>
		<option value="E1">Bee</option>
		<option value="U2">Purple Ballerina</option>
		<option value="K1">Dog</option>
		<option value="L1">Little Girl</option>
		<option value="M1">Medi Alert</option>
		<option value="N1">Star</option>
      </select> </td>
    <td>&nbsp;</td>
    <td> <select name="IdentiTag4" onChange="JavaScript: UpdateIdentiTagImage(4);">
        <option value="none" selected>[None]</option>
        <option value="A">Sun</option>
        <option value="S">Shark</option>
        <option value="C">Frangipani</option>
        <option value="T">Train</option>
        <option value="H">Butterfly</option>
        <option value="U">Ballerina</option>
        <option value="M">Dinosaur</option>
        <option value="V">Motorbike</option>
        <option value="N">Fairy</option>
        <option value="W">Horse</option>
        <option value="Q">Mermaid</option>
        <option value="X">Skull</option>
        <option value="R">Truck</option>
        <option value="Y">Surfer</option>
        <option value="C1">Frog</option>
        <option value="D1">Surfer Girl</option>
        <option value="Z">Pirate</option>
        <option value="P">Plane</option>
        <option value="E">Loveheart</option>
        <option value="A1">Cow</option>
        <option value="G1">Bear</option>
        <option value="H1">Pig</option>
        <option value="I1">Cat</option>
        <option value="J1">Spider</option>
		<option value="I">UFO</option>
		<option value="J">Car</option>
		<option value="F1">Rocket</option>
		<option value="E1">Bee</option>
		<option value="U2">Purple Ballerina</option>
		<option value="K1">Dog</option>
		<option value="L1">Little Girl</option>
		<option value="M1">Medi Alert</option>
		<option value="N1">Star</option>
      </select> </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="21">&nbsp;</td>
    <td><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Reverse 
        text</font></strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Reverse 
        text</font></strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Reverse 
        text</font></strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif">Reverse 
        text</font></strong></div></td>
  </tr>
  <tr> 
    <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input type="text" name="text5">
      </font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input type="text" name="text7">
      </font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input name="text9" type="text" id="text9">
      </font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input name="text11" type="text" id="text11">
      </font></td>
  </tr>
  <tr> 
    <td height="4" colspan="8"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input type="text" name="text6">
      </font></td>
    <td>&nbsp;</td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input type="text" name="text8">
      </font></td>
    <td>&nbsp;</td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input name="text10" type="text" id="text10">
      </font></td>
    <td>&nbsp;</td>
    <td><font size="2" face="Arial, Helvetica, sans-serif"> 
      <input name="text12" type="text" id="text12">
      </font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="8"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
</table>
<?
}

function addPicture($packNum=""){
?>
	
<table cellpadding="0" cellspacing="0" border="0">
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="1"> </td>
    <td><img src="../images/pc1.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="2"> </td>
    <td><img src="../images/pc2.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="28"> </td>
    <td><img src="../images/pc28.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="3"> </td>
    <td><img src="../images/pc3.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="4"> </td>
    <td><img src="../images/pc4.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="5"> </td>
    <td><img src="../images/pc5.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="6"> </td>
    <td><img src="../images/pc6.gif" border="0"></td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="7"> </td>
    <td><img src="../images/pc7.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="8"> </td>
    <td><img src="../images/pc8.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="9"> </td>
    <td><img src="../images/pc9.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="10"> </td>
    <td><img src="../images/pc10.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="11"> </td>
    <td><img src="../images/pc11.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="12"> </td>
    <td><img src="../images/pc12.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="13"> </td>
    <td><img src="../images/pc13.gif" border="0"></td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="14"> </td>
    <td><img src="../images/pc14.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="15"> </td>
    <td><img src="../images/pc15.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="16"> </td>
    <td><img src="../images/pc16.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="17"> </td>
    <td><img src="../images/pc17.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="18"> </td>
    <td><img src="../images/pc18.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="19"> </td>
    <td><img src="../images/pc19.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="20"> </td>
    <td><img src="../images/pc20.gif" border="0"></td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="21"> </td>
    <td><img src="../images/pc21.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="22"> </td>
    <td><img src="../images/pc22.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="23"> </td>
    <td><img src="../images/pc23.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="24"> </td>
    <td><img src="../images/pc24.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="25"> </td>
    <td><img src="../images/pc25.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="26"> </td>
    <td><img src="../images/pc26.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="27"> </td>
    <td><img src="../images/pc27.gif" border="0"></td>
  </tr>
  <tr> 
    <td height="10" colspan="20"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="29"> </td>
    <td><img src="../images/pc29.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="30"> </td>
    <td><img src="../images/pc30.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="31"> </td>
    <td><img src="../images/pc31.gif" border="0"></td>
    <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
    <td><img src="../images/spacer_trans.gif" border="0"> <input type="radio" name="<?=$packNum;?>pic" value="32"></td>
    <td><img src="../images/pc32.gif" width="50" height="50"></td>
    <td>&nbsp;</td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="33"></td>
    <td><img src="../images/pc33.gif" width="50" height="50"></td>
    <td>&nbsp;</td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="34"></td>
    <td><img src="../images/pc34.gif" width="50" height="50"></td>
    <td>&nbsp;</td>
    <td><input type="radio" name="<?=$packNum;?>pic" value="35"></td>
    <td><img src="../images/pc35.gif" width="50" height="50"></td>
  </tr>
  <tr> 
    <td height="10" colspan="20"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="36"></td>
    <td><img src="../images/pc36.gif" width="50" height="50"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><input type="radio" name="<?=$packNum;?>pic" value="none" checked> </td>
    <td class="admintext">No picture</td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
  <tr> 
    <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
  </tr>
</table>
	<?
}

//ZIPTAGS PICTURES
function addZiptagPicture($packnum=""){
	$rows = 1;
	echo "<table cellpadding='0' cellspacing='0' border='0'>";
	echo "<tr>";
	for ($i=1; $i<=35; $i++)
	{
		echo "<td><img src='../images/ziptags/".$i.".gif'></td>";
		echo "<td><img src='../images/spacer_trans.gif' height='1' width='3' border='0'></td>";
        echo "<td><input type='radio' name='".$packnum."pic' value='".$i."'></td>";
		echo "<td><img src='../images/spacer_trans.gif' height='1' width='25' border='0'></td>";
		if ($rows % 5 == 0){
			echo "</tr><tr><td colspan='4' height='5'></td></tr><tr>"; 
		}
		$rows++;
	}
	echo "</tr></table><BR />";
}

//IDENTITAGS PICTURES
function addIdentitagPicture($packnum=""){
	$sql = "SELECT *
				FROM data_identitag
				ORDER BY data_identitag_code ASC ";
	$result = db_query($sql);
	?><table cellpadding='0' cellspacing='0' border='0'><tr><?
	$rows = 1;
	while($record = db_fetch_array($result))
	{
		?><td><img src="../images/identitags/<?=$record['data_identitag_code']?>.gif"></td>
		<td style="font-size: 11pt; font-face: bold;"><img src="../images/spacer_trans.gif" height="1" width="3" border="0"><?=$record['data_identitag_code']?></td>
        <td><input type="radio" name="<?=$packnum?>pic" value="<?=$record['data_identitag_code']?>"></td>
		<td><img src='../images/spacer_trans.gif' height='1' width='25' border="0"></td>
		<?
		if ($rows % 5 == 0){
			?></tr><tr><td colspan='4' height='5'></td></tr><tr><?
		}
		$rows++;
	}
	?></tr></table><BR /><?
} 

//IDENTIBANDS PICTURES
function addIdentibandPicture($packnum=""){
	$sql = "SELECT *
				FROM data_identiband
				ORDER BY data_identiband_code ASC ";
	$result = db_query($sql);
	?><table cellpadding='0' cellspacing='0' border='0'><tr><?
	$rows = 1;
	while($record = db_fetch_array($result))
	{
		?><td><img src="../images/identibands/<?=$record['data_identiband_code']?>.gif"></td>
		<td style="font-size: 11pt; font-face: bold;"><img src="../images/spacer_trans.gif" height="1" width="3" border="0"><?=$record['data_identiband_code']?></td>
        <td><input type="radio" name="<?=$packnum?>pic" value="<?=$record['data_identiband_code']?>"></td>
		<td><img src='../images/spacer_trans.gif' height='1' width='25' border="0"></td>
		<?
		if ($rows % 2 == 0){
			?></tr><tr><td colspan='4' height='5'></td></tr><tr><?
		}
		$rows++;
	}
	?></tr></table><BR /><?
} 


function addAllergyPicture(){
?>
	<table cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
      </tr>
      <tr>
        <td><input type="radio" name="pic" value="1">
        </td>
        <td><img src="../images/aa01.gif" border="0"></td>
        <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        <td><input type="radio" name="pic" value="2">
        </td>
        <td><img src="../images/aa02.gif" border="0"></td>
        <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        <td><input type="radio" name="pic" value="3">
        </td>
        <td><img src="../images/aa03.gif" border="0"></td>
        <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        <td><input type="radio" name="pic" value="4">
        </td>
        <td><img src="../images/aa04.gif" border="0"></td>
        <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        <td><input type="radio" name="pic" value="5">
        </td>
        <td><img src="../images/aa05.gif" border="0"></td>
        <td><img src="../images/spacer_trans.gif" height="1" width="10" border="0"></td>
        <td><input type="radio" name="pic" value="6">
        </td>
        <td><img src="../images/aa06.gif" border="0"></td>
      </tr>
      <tr>
        <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
      </tr>
      <tr>
        <td><input type="radio" name="pic" value="none" checked>
        </td>
        <td class="admintext">No picture</td>
      </tr>
      <tr>
        <td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
      </tr>

    </table>
	<?
}



function addName($required, $split, $packNum=""){
	?>
<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<? if($required!=true){?>
		<tr>
			<td class="admintext">Name: <input type="text" name="<?=$packNum;?>text1" value=""><br><input type="checkbox" name="<?=$packNum;?>noname" onClick="if(document.forms[0].<?=$packNum;?>noname.checked==true){ document.forms[0].<?=$packNum;?>text1.value=''; document.forms[0].<?=$packNum;?>text1.disabled=true; }else{ document.forms[0].<?=$packNum;?>text1.disabled=false}">&nbsp;No name</td>
		</tr>
		<? }else{ ?>
		<tr>
			<td class="admintext">Name: <input type="text" name="<?=$packNum;?>text1" value=""></td>
		</tr>
		<? }
		if($split==true){ ?>
		<tr>
			<td class="admintext"><input type="checkbox" name="<?=$packNum;?>split" disabled onClick="document.forms[0].<?=$packNum;?>nophone.checked=true; document.forms[0].<?=$packNum;?>text2.value=''; document.forms[0].<?=$packNum;?>text2.disabled=true;">&nbsp;Split into 2 lines</td>
		</tr>
		<? } ?>
</table>
<?
}

function addDiyText(){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Text 1: <input type="text" name="text1" value="">&nbsp;&nbsp;<input type="checkbox" name="text1use" onClick="if(document.forms[0].text1use.checked==false){ document.forms[0].text1.value=''; document.forms[0].text1.disabled=true; }else{ document.forms[0].text1.disabled=false}" checked>&nbsp;Use</td>
		</tr>
		<tr>
			<td class="admintext">Text 2: <input type="text" name="text2" value="">&nbsp;&nbsp;<input type="checkbox" name="text2use" onClick="if(document.forms[0].text2use.checked==false){ document.forms[0].text2.value=''; document.forms[0].text2.disabled=true; }else{ document.forms[0].text2.disabled=false}" checked>&nbsp;Use</td>
		</tr>
		<tr>
			<td class="admintext">Text 3: <input type="text" name="text3" value="">&nbsp;&nbsp;<input type="checkbox" name="text3use" onClick="if(document.forms[0].text3use.checked==false){ document.forms[0].text3.value=''; document.forms[0].text3.disabled=true; }else{ document.forms[0].text3.disabled=false}" checked>&nbsp;Use</td>
		</tr>
		<tr>
			<td class="admintext">Text 4: <input type="text" name="text4" value="">&nbsp;&nbsp;<input type="checkbox" name="text4use" onClick="if(document.forms[0].text4use.checked==false){ document.forms[0].text4.value=''; document.forms[0].text4.disabled=true; }else{ document.forms[0].text4.disabled=false}" checked>&nbsp;Use</td>
		</tr>
		<tr>
			<td class="admintext">Text 5: <input type="text" name="text5" value="">&nbsp;&nbsp;<input type="checkbox" name="text5use" onClick="if(document.forms[0].text5use.checked==false){ document.forms[0].text5.value=''; document.forms[0].text5.disabled=true; }else{ document.forms[0].text5.disabled=false}" checked>&nbsp;Use</td>
		</tr>
	</table>
<?
}

function addPhone($required, $packNum=""){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<? if($required!=true){?>
		<tr>
			<td class="admintext">Phone: <input type="text" name="<?=$packNum;?>text2" value=""><br><input type="checkbox" name="<?=$packNum;?>nophone" onClick="if(document.forms[0].<?=$packNum;?>nophone.checked==true){ document.forms[0].<?=$packNum;?>text2.value=''; document.forms[0].<?=$packNum;?>text2.disabled=true; document.forms[0].<?=$packNum;?>split.disabled=false; }else{ document.forms[0].<?=$packNum;?>text2.disabled=false; document.forms[0].<?=$packNum;?>split.checked=false; document.forms[0].<?=$packNum;?>split.disabled=true;}">&nbsp;No phone</td>
		</tr>
		<? }else{ ?>
		<tr>
			<td class="admintext">Phone: <input type="text" name="<?=$packNum;?>text2" value=""></td>
		</tr>
		<? }?>
	</table>
	<?
}

function addColoursBoysGirls($packNum=""){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Colours: <input type="radio" name="<?=$packNum;?>colours" value="1">&nbsp;Rainbow A&nbsp;&nbsp;<input type="radio" name="<?=$packNum;?>colours" value="2" checked>&nbsp;Rainbow B</td>
		</tr>
	</table>
	<?
}

function addColoursBoysGirlsBoth(){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Colours: <input type="checkbox" name="colours1" value="1" checked>&nbsp;Boys&nbsp;&nbsp;<input type="checkbox" name="colours2" value="1">&nbsp;Girls</td>
		</tr>
	</table>
	<?
}

function addColoursDef(){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext">Colours:&nbsp;&nbsp;</td>
			<td class="admintext" align="left"><input type="checkbox" name="colours1" value="Tomato Red" onClick="diycolours(1);">&nbsp;Tomato Red</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours2" value="Sky Blue" onClick="diycolours(2);">&nbsp;Sky Blue</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours3" value="Sunny Yellow" onClick="diycolours(3);">&nbsp;Sunny Yellow</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours4" value="Zesty Orange" onClick="diycolours(4);">&nbsp;Zesty Orange</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours5" value="Kiwi Lime" onClick="diycolours(5);">&nbsp;Kiwi Lime</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours6" value="Lavender" onClick="diycolours(6);">&nbsp;Lavender</td>
		</tr>
		<tr>
			<td><img src="../images/spacer_trans.gif" height="1" width="1" border="0"></td>
			<td class="admintext" align="left"><input type="checkbox" name="colours7" value="Hot Pink" onClick="diycolours(7);">&nbsp;Hot Pink</td>
		</tr>
	</table>
	<?
}


function font_colour_select($field_name='font_colour')
{
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext" width="100">Font Colour:&nbsp;&nbsp;</td>
			<td class="admintext" align="left"><select name="<?= $field_name; ?>" onChange="change_background_colour(this.form); ">
			<?
			$sql = "SELECT * FROM data_font_colour ORDER BY data_font_colour_id";
			$result = db_query($sql);
			if($result == true)
			{
				while($record = db_fetch_array($result))
				{
					?><option value="<?= (int)$record['data_font_colour_id']; ?>"><?= htmlspecialchars($record['data_font_colour_name']); ?></option><?
				}
			}
			?>
			</select></td>
		</tr>
	</table>
	<?
	
}

function background_colour_select($field_name='colour', $background_colours=false, $background_colours_only=false){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td class="admintext" width="100">Colour:&nbsp;&nbsp;</td>
			<td class="admintext" align="left"><select name="<?=$field_name; ?>" onChange="change_background_colour(this.form); ">
			<?
			$sql = "SELECT * FROM data_colour";
			
			if($background_colours_only == true)
			{
				$sql .= " WHERE data_colour_background='1' ";
			}
			elseif($background_colours == false)
			{
				$sql .= " WHERE data_colour_background='0' ";
			}
			$sql .= " ORDER BY data_colour_id";
			
			$result = db_query($sql);
			if($result == true)
			{
				while($record = db_fetch_array($result))
				{
					?><option value="<?= (int)$record['data_colour_id']; ?>"><?= htmlspecialchars($record['data_colour_name']); ?></option><?
				}
			}
			?>
			</select></td>
		</tr>
	</table>
	<?
}



function AddIdentiTagSelectionLists(){
?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>IdentiTag # 1:</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<select name="text3" disabled>
					<option value="" selected>[None]</option>
					<option value="A">Sun</option>
					<option value="S">Shark</option>
					<option value="C">Frangipani</option>
					<option value="T">Train</option>
					<option value="H">Butterfly</option>
					<option value="U">Ballerina</option>
					<option value="M">Dinosaur</option>
					<option value="V">Motorbike</option>
					<option value="N">Fairy</option>
					<option value="W">Horse</option>
					<option value="Q">Mermaid</option>
					<option value="X">Skull</option>
					<option value="R">Truck</option>
					<option value="Y">Surfer</option>
					<option value="C1">Frog</option>
					<option value="D1">Surfer Girl</option>
					<option value="Z">Pirate</option>
					<option value="P">Plane</option>
					<option value="E">Loveheart</option>
					<option value="J">Car</option>
					<option value="F1">Rocket</option>
					<option value="I">UFO</option>
					<option value="E1">Bee</option>
					<option value="A1">Cow</option>
					<option value="G1">Bear</option>
					<option value="H1">Pig</option>
					<option value="I1">Cat</option>
					<option value="J1">Spider</option>
			  </select>
			</td>
		</tr>
	</table>
<?php
}

function add_identitag($field_name='text3', $label='IdentiTag:', $none_allowed=true){
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="100"><?= $label; ?></td>
			<td>
				<select name="<?= $field_name; ?>">
				<?
				if($none_allowed == true)
				{
					?><option value="">[None]</option><?
				}

				$sql = "SELECT * FROM data_identitag ORDER BY data_identitag_code";
				$result = db_query($sql);
				while($record = db_fetch_array($result))
				{
					?>
					<option value="<?= htmlspecialchars($record['data_identitag_id']); ?>"><?= htmlspecialchars($record['data_identitag_code']); ?>: <?= htmlspecialchars($record['data_identitag_name']); ?></option>
					<?
				}
				?>
				</select>
			</td>
		</tr>
	</table>
	<?
}

function AddGiftCardSelectionLists(){
?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>Gift Card # 1:</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<select name="text5" disabled>
				<option value="" selected>[None]</option>
				<option value="6">Flower</option>
				<option value="1">Sun</option>
				<option value="16">Mermaid</option>
				<option value="4">Heart</option>
				<option value="13">Fairy</option>
				<option value="7">Butterfly</option>
				<option value="20">Ballerina</option>

				<option value="15">Aeroplane</option>
				<option value="11">Star</option>
				<option value="19">Train</option>
				<option value="18">Shark</option>
				<option value="9">Car</option>
				<option value="17">Truck</option>
				<option value="12">Dinosaur</option>
				<?

				/*
				UNUSED GRAPHICS FOR GIFT CARDS.
				<option value="2">Boy</option>
				<option value="3">Mouse</option>
				<option value="5">Girl</option>
				<option value="8">UFO</option>
				<option value="10">Alien</option>
				<option value="14">Dog</option>
				<option value="21">Motorbike</option>
				<option value="22">Horse</option>
				<option value="23">Skull</option>
				<option value="24">Surfer</option>
				<option value="25">Pirate</option>
				<option value="26">Cow</option>
				<option value="27">Chicken</option>
				<option value="28">Frangipani</option>
				*/

				?>			
			  </select>
			</td>
		</tr>
	</table>
<?php
}

function addgiftvoucher(){
?>
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		  <td><div align="center"><strong>Voucher Style</strong></div></td>
		  <td><div align="center"><strong>Voucher Quantity</strong></div></td>
		  <td><div align="center"><strong>Voucher Value</strong></div></td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td colspan="4"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
	  </tr>
		<tr>
		  <td width="125">
			  <div align="center">
				<select name="VoucherStyle" style="width: 100%" onChange="JavaScript: UpdateForm();">
				  <option value="baby">Baby Voucher</option>
				  <option value="girl">Girl Voucher</option>
				  <option value="boy">Boy Voucher</option>
				</select>
	</div></td>
			<td width="125">
			  <div align="center">
				<input name="VoucherQuantity" type="text" style="width: 100%; text-align: center">
			  </div></td>
			<td width="125">			  
			  <div align="center">
				<input name="VoucherValue" type="text" disabled="true" style="width: 100%; text-align: center" value="35">
			  </div></td>
			<td width="150">
			  <div align="center">
				<input name="Add" type="button" style="width: 125" onClick="JavaScript: AddVoucher();" value="Add Voucher">
	</div></td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td><div align="center"><strong>Quantity Ordered</strong></div></td>
		  <td><div align="center"><strong>Style of Voucher</strong></div></td>
		  <td><div align="center"><strong>Value of Each Voucher</strong></div></td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td colspan="4"><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
	  </tr>
		<tr>
		  <td rowspan="2" valign="top">
			  <div align="center">
					<select name="QuantityList" size="2" style="width: 100%; text-align: center" onChange="JavaScript: UpdateLists('Quantity');"></select>
		  </div></td>
		  <td rowspan="2" valign="top">
			  <div align="center">
					<select name="StyleList" size="2" style="width: 100%; text-align: center" onChange="JavaScript: UpdateLists('Style');"></select>
		  </div></td>
		  <td rowspan="2" valign="top">
			  <div align="center">
					<select name="ValueList" size="2" style="width: 100%; text-align: center" onChange="JavaScript: UpdateLists('Value');"></select>
	</div></td>
		  <td valign="top">
			<div align="center">
			  <input name="Remove" type="button" style="width: 125" onClick="JavaScript: RemoveVoucher();" value="Remove Voucher">
		  </div></td>
	  </tr>
		<tr>
		  <td valign="top">&nbsp;</td>
		</tr>
	</table>
<?php	
}

function validateForm(){
?>
<script language="javascript">
	function validateForm(){
		if(document.forms[0].type.value<3 || document.forms[0].type.value==6 || (document.forms[0].type.value>9 && document.forms[0].type.value<13)){
			if(document.forms[0].text1.value==""){
				alert('You must enter a name');
				return false;
			}else if(document.forms[0].text2.value=="" && document.forms[0].nophone && document.forms[0].nophone.checked==false){
				alert('You must enter a phone number, or select no phone');
				return false;
			}else{
				return true;
			}
		}else if(document.forms[0].type.value==3 || document.forms[0].type.value==5){
			if(document.forms[0].text1.value==""){
				alert('You must enter a name');
				return false;
			}
		}else if(document.forms[0].type.value==8 || document.forms[0].type.value==9){
			i=1;
			found=false;
			while(document.forms[0]['colours'+i]){
				if(document.forms[0]['colours'+i].checked==true){
					found=true;
					break;
				}
				i++;
			}
			if(found==false){
				alert('You must choose at least one colour');
				return false;
			}else{
				return true;
			}
		}else if(document.forms[0].type.value==14){
			if(iTagList.length==0){
				alert('You must choose at least one card');
				return false;
			}else{
				val="";
				for(i=0; i<iTagList.length; i++){
					if(i!=0) val+=":";
					//val += document.forms[0]['pic'+iTagList[i]].value;
					val += iTagList[i];
					
				}
				document.forms[0].cardsVal.value=val;
				return true;
			}
		} else if(document.forms[0].type.value == 34 ){
			if(document.forms[0].maxi_pack1_name.value==""){
				alert('You must enter a name');
				return false;
			}else{
				return true;
			}
		}
		
		// The following applies only to Gift Voucher orders
		if (document.forms[0].type.value == 15){
			var Proceed = false;
			var LoopCounter = 0;
			var VoucherCount = document.forms.additem.QuantityList.options.length;
			var VoucherOrder = new Array(VoucherCount);
			//window.alert("Proceed = " + Proceed);
			//window.alert("LoopCounter = " + LoopCounter);
			//window.alert("VoucherCount = " + VoucherCount);
		
			if (VoucherCount > 0){
				for (LoopCounter = 0; LoopCounter < VoucherCount; LoopCounter++){
					VoucherOrder[LoopCounter] = new Array(3);
					VoucherOrder[LoopCounter][0] = document.forms.additem.QuantityList.options[LoopCounter].text;
					VoucherOrder[LoopCounter][1] = document.forms.additem.StyleList.options[LoopCounter].text;
					VoucherOrder[LoopCounter][2] = document.forms.additem.ValueList.options[LoopCounter].text;
					//window.alert(document.forms.additem.QuantityList.options[LoopCounter].text);
				}
				//window.alert("VoucherOrder[0][0] = " + VoucherOrder[0][0]);
				//window.alert("VoucherOrder[0][1] = " + VoucherOrder[0][1]);
				//window.alert("VoucherOrder[0][2] = " + VoucherOrder[0][2]);
				document.forms.additem.VoucherOrders.value = VoucherOrder;
				Proceed = true;
			}
			return Proceed;
		}
	}
	diyar = new Array();
	function diycolours(num){
		if(document.forms[0]['colours'+num].checked==true){
			if(diyar.length>1){
				diyar.pop();
			}
			diyar.unshift(num);
		}else{
			if(diyar[0]==num){
				diyar.reverse();
			}
			diyar.pop();
		}
		i=1;
		while(document.forms[0]['colours'+i]){
			if(diyar[0]==i || diyar[1]==i){
				document.forms[0]['colours'+i].checked=true;
			}else{
				document.forms[0]['colours'+i].checked=false;
			}
			i++;
		}
	}
</script>
<?
}


function validateFormSharedPack(){
?>
<script language="javascript">
	function validateForm(){
		var pack1=document.additem.pack1[document.additem.pack1.selectedIndex].value;
		var pack2=document.additem.pack2[document.additem.pack2.selectedIndex].value;

//alert(document.additem.pack1_colours[0].checked);


		// validate pack 1
		if(document.forms[0].pack1_text1.value==""){
			alert('You must enter a name in Pack 1');
			return false;
		}else if(document.forms[0].pack1_text2.value=="" && document.forms[0].pack1_nophone && document.forms[0].pack1_nophone.checked==false){
			alert('You must enter a phone number, or select no phone for Pack 1');
			return false;
		}else	if(document.forms[0].pack2_text1.value==""){
		// validate pack 2	
			alert('You must enter a name in Pack 2');
			return false;
		}else if(document.forms[0].pack2_text2.value=="" && document.forms[0].pack2_nophone && document.forms[0].pack2_nophone.checked==false){
			alert('You must enter a phone number, or select no phone for Pack 2');
			return false;
		}
	//	}else{
			// validate colours.
			/*if(pack1!=2 && document.additem.pack1_colours[0].checked==false && document.additem.pack1_colours[1].checked==false)){
				alert('You must select a colour for Pack 1');
				return false;
			}else	if(pack2!=2 && document.additem.pack2_colours[0].checked==false && document.additem.pack2_colours[1].checked==false)){
				alert('You must select a colour for Pack 2');
				return false;
			}else{
				return false; // true;
			}*/
		//}
	}

</script>
<?
}

function submitButton(){
?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="../images/spacer_trans.gif" height="5" width="1" border="0"></td>
		</tr>
		<tr>
			<td><input type="submit" value="&nbsp;add >&nbsp;"></td>
		</tr>
	</table>
<?
}
?>