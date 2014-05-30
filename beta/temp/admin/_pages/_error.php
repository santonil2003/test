<td width="100%" valign="top"><h1>Error</h1>
	<p>An error has occured.</p>
    <p>Error: <?=$errstr?>.</p>
    <br/><p>This error was fatal, program ending.
	Please contact us and tell us an error occurred at line <span class="errormsg"><?=$errline?></span> of <span class="errormsg">'<?=str_replace('_','',$errfile)?>'</span></p>
</td>