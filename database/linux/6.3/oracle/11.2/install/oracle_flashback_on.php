<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Включить режим работы FLASH BACK</h2>

<br/><br/>

<pre>
FlashBack бывает полезен, когда нужно откатить изменения или посмотреть предыдущее состояние объектов в базе данных.
Как следствие растет нагрузка на сервер, т.к. приходится хранить дополнительную информацию. 

$ sqlplus / as sysdba
SQL> shutdown immediate;
SQL> startup mount exclusive;
SQL> alter database flashback on;
SQL> alter database open;

   
SQL> select flashback_on from v$database;

FLASHBACK_ON
------------------
YES



UNDO_RETENTION - (при включенном FLASHBACK) определяет минимальное время в секундах, за которое можно отменить (посмотреть) изменение в базе данных. При этом данные будут храниться в UNDO_TABLESPACE (необходимо обеспечить достаточный размер табличного пространства) и перезаписываться по мере необходимости, обеспечивая минимальное значение, указанное в UNDO_RETENTION. Не поддерживается для LOB.


Задаю параметр UNDO_RETENTION равный 30 минутам
SQL> alter system set UNDO_RETENTION = 1800;
SQL> alter tablespace UNDO RETENTION GUARANTEE;

SQL> show parameter UNDO_RETENTION

NAME                                 TYPE        VALUE
------------------------------------ ----------- ------------------------------
undo_retention                       integer     1800



SQL> quit



</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
