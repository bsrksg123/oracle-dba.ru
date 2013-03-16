<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h3>Команды для анализа использования UNDOTBS</h3><br/>

<pre>

/*
Display sizes of active, unexpired and expired UNDO extents 
*/

select status, round(sum(bytes)/1024/1024) as "Size, MB" from dba_undo_extents group by status;

/*
Display UNDO utilization details per user session (SID, User Name) 
*/

select a.sid, a.username, a.osuser, round(b.used_ublk*8/1024) as "RBS Size, MB",
  b.used_urec as "Undo records", c.name "RBS Name", b.start_time
from v$session a, v$transaction b, v$rollname c
where b.addr = a.taddr and c.usn = b.xidusn;

</pre>
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
