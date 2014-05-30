<form action="/temp/searchresult.php" method="post" name="frmsearch" id="frmsearch" onSubmit="javascript:return validate_search();">
	<span class="">Search : </span>
	<input type="text" name="search" id="search" value="<?php echo trim($_POST['search']); ?>" />
	&nbsp;&nbsp;
	<input type="submit" name="submit" id="submit" value="Search" />
</form>
<script type="text/javascript">
function validate_search()
{
	if(!document.getElementById('search').value)
	{
		alert('Please enter the search keyword');
		document.getElementById('search').focus();
		return false;
	}
	return true;
}
</script>
