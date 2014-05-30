<td rowspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="20">
<tr>
<td width="100%" valign="top"><h1>Error</h1>
	<p>An error has occured.</p>
    <p>Error: <?=$errstr?>.</p>
    <br/><p>This error was fatal, execution of this page has ended</p>
	<p>Please contact us and tell us an error occurred at line <span class="errormsg"><?=$errline?></span> of <span class="errormsg">'<?=str_replace('_','',$errfile)?>'</span></p>
    <p><a href="javascript:history.go(-1);">Go back and try again</a>.</p>
</td>
</tr></table></td>