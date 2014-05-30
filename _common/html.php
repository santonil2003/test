<?


function printDatePulldowns($name, $date){
	list($day,$month,$year)=split("/", $date);
	?><select name="<?=$name?>_day"><?
		for($i=1; $i<=31; $i++){
			$t_day = sprintf("%02d", $i);
			$SELECTED=($day==$t_day)?"SELECTED":"";
			print "<option $SELECTED>$t_day</option>\n";
		}
	?></select> / <select name="<?=$name?>_month"><?
		for($i=1; $i<=12; $i++){
			$t_month = sprintf("%02d", $i);
			$SELECTED=($month==$t_month)?"SELECTED":"";
			print "<option $SELECTED>$t_month</option>\n";
		}
	?></select> / <select name="<?=$name?>_year"><?
		for($i=2004; $i<=date("Y")+10; $i++){
			$t_year = sprintf("%04d", $i);
			$SELECTED=($year==$t_year)?"SELECTED":"";
			print "<option $SELECTED>$t_year</option>\n";
		}
	?></select><?
}

function html_pulldown($name, $values, $default="", $keys=false, $extra="", $print=true)
{

	$output_text = "<select name=\"{$name}\" {$extra}>\n";
	foreach($values as $key => $value)
	{
		$key = ($keys)?$key:$value;
		$SELECTED = ($key==$default)?"SELECTED":"";
		$output_text .= "<option value=\"{$key}\" {$SELECTED}>{$value}</option>\n";
	}
	$output_text .= "</select>\n";
	
	if($print == true)
	{
		echo $output_text;
	}
	else 
	{
		return $output_text;
	}
}

function form_param($param_name)
{
	assert(is_string($param_name));
	if(isset($_POST[$param_name]) == true)
	{
		return stripslashes(trim($_POST[$param_name]));
	}
	else 
	{
		return "";
	}
}

function param($param_name)
{
	assert(is_string($param_name));
	
	if(isset($_POST[$param_name]))
	{
		return stripslashes(trim($_POST[$param_name]));
	}
	elseif(isset($_GET[$param_name]))
	{
		return stripslashes(trim($_GET[$param_name]));
	}
	else 
	{
		return '';
	}
}

function pagination($num_results, $page, $results_per_page, &$limit_start, $admin_active=false,  $variables=array())
{
	// pagination
	if((int)$page < 1)
	{
		$page = 1;
	}
	
	
	$limit_start = ($page * $results_per_page ) - $results_per_page;
	$limit_end = ($page * $results_per_page) ;
	if($num_results < $limit_end)
	{
		$limit_end = $num_results;
	}
	
	$pages = ceil($num_results / $results_per_page);

	$output ='
	<form name="pagination" method="GET" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" style="margin-bottom: 0px;">
	<script type="text/javascript">
	function submit_pagination(page_number)
	{
		document.pagination.page.selectedIndex=page_number - 1;
		document.pagination.submit();
	}
	</script>
	';
	if(sizeof($variables) > 0)
	{
		foreach($variables as $key => $value)
		{
			$output .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
		}
		
	}
	
	$output .= '<table width="100%" border="0" cellpadding="0" cellspacing="2">
		<tr>
			<td width="15%" valign="top">Results: <strong>' . (int)($limit_start+1) . '</strong> to <strong>' . (int)$limit_end . '</strong> of <strong>' . (int)$num_results . '</strong></td>
			<td align="center">Page: ';
	
			for($i=1; $i<=$pages; $i++)
			{
				if($i==$page)
				{
					$output .= '<strong>' . (int)$i . '</strong> &nbsp;';
				}
				else 
				{
					$output .= '<a href="#" onClick="submit_pagination(' . (int)$i . '); return false;">' . (int)$i . '</a> &nbsp;';
				}
			}
			$output .= '</td>';
			$pulldown = "";
			if($admin_active == true)
			{
				if(isset($_GET['active']) == true)
				{
					$active = (int)param('active');
				}
				else 
				{
					$active = 1;
				}
				$pulldown = "<br />" . html_pulldown('active', array("1" => "Active", "0" => "In-Active"), $active, true, ' onChange="this.form.submit();" ', false);
//				$output .= '<td valign="top">' . $pulldown . '</td>';
			}
			$output .= '<td width="15%" align="right" valign="top" nowrap>Go To Page: ' . html_pulldown('page', range(1, $pages), $page, false, ' class="pagination_pulldown" onChange="document.pagination.submit();"', false) . $pulldown . '</td>
		</tr>
	</table>
	</form>';
			
	return $output;
}

?>