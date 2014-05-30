<?PHP

	require_once "header_new.php";

?>
	</td>
	
<td valign=top> 
  <?PHP

if($sub_menu){
	?>
  <table width="100%" border="0" cellspacing="0" bgcolor="#FFEED6">
    <tr bgcolor="#FFFFFF"> 
      <td height="15" colspan="2"></td>
    </tr>
    <tr> 
      <td width="10%">&nbsp;</td>
      <td><div class="adminBody"><br>
          <br>
          <a href="javascript:submitForm(document.edit, 'create', '-1');">Create 
          Job Vacancy</a> <br>
          <br>
          <br>
        </div></td>
    </tr>
  </table>

	<SCRIPT type="text/javascript">
	<!--
	
	function submitForm(f, in_section, in_id)
	{
		f.section.value=in_section;
		f.id.value=in_id;

		if(f.section.value=="delete")
		{
			var answer = confirm("Are you sure you want to delete this job vacancy?");
			if(answer)
			{
				f.submit();
			}
		}
		else {
			f.submit();
		}
	}
	
	// -->
	</SCRIPT>
	<?
}

?>
<SCRIPT type="text/javascript">
<!--

	function validatedate(day,month,year)
	{
		var maxdays,i;
		if (month.value == 1||month.value == 3||month.value == 5||month.value == 7||month.value == 8||month.value == 10||month.value == 12)
	  	maxdays=31;
		else
			if (month.value != 2)
	  		maxdays=30;
			else
				maxdays=(year.value%4)?(year.value%100)?(year.value%400)?28:29:28:29;
		while (day.length < maxdays)
			day[day.length]=new Option(day.length+1,day.length+1);
		while (day[maxdays]) {
			if (day.selectedIndex >= maxdays)
				day.selectedIndex=maxdays-1;
	  day[maxdays]=null;
	  }
	}
// -->
</SCRIPT>