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