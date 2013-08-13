<html>
<head>
<title>Get Easy Results</title>
</head>
<body>
<?php
$roll_len=8;
$url='http://vrsiddhartha.ac.in/result/2semr.asp';
$field_name='appno';


if(isset($_REQUEST['from']))
	$from=$_REQUEST['from'];
else
	$from='';
if(isset($_REQUEST['to']))
	$to=$_REQUEST['to'];
else
	$to='';
?>
<h1>Result Script</h1>
<form method=post>
<h2>Get Everyone's Result the Easy Way</h2><br/>
<br/>
Just enter the from and to roll number and it will list those numbers here and can open each in a new tab if you want<br/>
<table>
<tr><td>From:</td><td><input size=10 name='from' type='text' value="<?php echo $from; ?>" size="6" />(For Eg. Y08CS001 )<br/></td></tr>
<tr><td>To:</td><td><input size=10 name='to' type='text' value="<?php echo $to; ?>" size="6" />(For Eg. Y08CS001 )<br/></td></tr>
<tr><td></td><td><input type="checkbox" name="open" value="yes" <?php if(isset($_REQUEST['open'])) echo "checked=\"checked\""; ?> />Check this to open every roll number in the list in a new tab automatically<br/>(Might ask you to enable popups for this site)</td></tr>
<tr><td><input type='submit' value='Send'></td></tr>
</form>
</table>
<?php
	
	function showlast()
	{
		echo	"<br/><br/><center><small><a href=\"http://blog.gagan.pro\" title=\"My Blogging Page\" style=\"text-decoration:none;color:black;\">~by Gagan~</a></small></center><br/>";
	}

	function kill()
	{
		echo "Error in Input(May be wrong Roll Number)";
		showlast();
		die();
	}
	if(isset($_REQUEST['from']) && !empty($_REQUEST['from']))
	{
		if(isset($_REQUEST['to']) && !empty($_REQUEST['to']))
		{
			if(strlen($from)!==8 || strlen($to)!==8)
				kill();
			
			for($n=0;$n<strlen($from);$n++)
			{
				if(strncmp($from,$to,$n)!==0)
					break;
			}
			$n--;
			if($n>0)
			{
				$pre=substr($from,0,$n);
				$sub_from=substr($from,$n);
				$sub_to=substr($to,$n);
				$from=(int)$sub_from;
				$to=(int)$sub_to;
			}
			else
				kill();
			echo "<table cellspacing=0 cellpadding=0>";
			$pre=strtoupper($pre);
			//$pre="BT07";
			//echo "<tr>";
			$aligner=0;
			for($r=$from;$r<=$to;$r++,$aligner++)
			{
				$rno=$pre.$r;
				$k=1;
				while(strlen($rno)<$roll_length)
				{
					$rno=$pre;
					for($i=0;$i<$k;$i++)
					{
						$rno.="0";
					}
					$k++;
					$rno.=$r;
				}
				if($aligner%10==0)
					echo "<tr>";
				echo "<td><form name=f$rno action=\"$url\" method=\"POST\" style=\"color: #FF0000\" target=\"_blank\">
				<input type=\"hidden\" name=\"$field_name\" size=\"20\" value='$rno' >
				<input type=\"submit\" value=\"$rno\" style='width:95px' /> </form></td>";
				if(isset($_REQUEST['open'])) echo "<script>document.f$rno.submit();</script>";
				if($aligner%10==9)
				{
					echo "</tr>";
				}
			}
			echo "</table>";
		}
		else
		{
			echo "<br/>Enter the to field";
		}
	}
	else
	{
		echo "<br/>Enter the from field";
	}
	showlast();

?>

</body>
</html>