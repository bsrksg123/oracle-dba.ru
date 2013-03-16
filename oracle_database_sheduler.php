<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Sheduler</h2><br/>


<br/><br/>


Sheduler - помогает автоматизировать задания внутри базы данных Oracle. Состоит из 
пяти базовых компонентов:
<ul>
<li>заданий (jobs)</li>
<li>расписаний (shedules)</li>
<li>программ</li>
<li>событий</li>
<li>цепочек</li>
</ul>

<br/>
<br/>


<br/><br/>


SQL> set pagesize 0;<br/>
SQL> SELECT owner, job_name, job_type FROM dba_scheduler_jobs;

<br/><br/>

<pre>

SYS                            XMLDB_NFS_CLEANUP_JOB          STORED_PROCEDURE
SYS                            SM$CLEAN_AUTO_SPLIT_MERGE      PLSQL_BLOCK
SYS                            RSE$CLEAN_RECOVERABLE_SCRIPT   PLSQL_BLOCK
SYS                            FGR$AUTOPURGE_JOB              PLSQL_BLOCK
SYS                            BSLN_MAINTAIN_STATS_JOB
SYS                            DRA_REEVALUATE_OPEN_FAILURES   STORED_PROCEDURE
SYS                            HM_CREATE_OFFLINE_DICTIONARY   STORED_PROCEDURE
SYS                            ORA$AUTOTASK_CLEAN
SYS                            FILE_WATCHER
SYS                            PURGE_LOG
ORACLE_OCM                     MGMT_STATS_CONFIG_JOB          STORED_PROCEDURE
ORACLE_OCM                     MGMT_CONFIG_JOB                STORED_PROCEDURE
EXFSYS                         RLM$SCHDNEGACTION              PLSQL_BLOCK
EXFSYS                         RLM$EVTCLEANUP                 PLSQL_BLOCK

14 rows selected.




</pre>
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
