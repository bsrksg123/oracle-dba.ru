<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Табличные пространства Oracle</h2><br/>


<br/><br/>

<table class="FormalWide" title="Tablespace Names Used with Oracle Real Application Clusters Databases" summary="This table is described in the preceding text" dir="ltr" frame="border" rules="all" width="100%" cellpadding="3" cellspacing="0" border="1">
<colgroup><col width="24%">
<col width="*">
</colgroup><thead>
<tr align="left" valign="top">
<th id="r1c1-t4" align="left" valign="bottom">Tablespace Name</th>
<th id="r1c2-t4" align="left" valign="bottom">Contents</th>
</tr>
</thead>
<tbody>
<tr align="left" valign="top">
<td id="r2c1-t4" headers="r1c1-t4" align="left">
<p><code>SYSTEM</code><a id="sthref399" name="sthref399"></a><a id="sthref400" name="sthref400"></a></p>
</td>
<td headers="r2c1-t4 r1c2-t4" align="left">
<p>A mandatory tablespace that consists of the data dictionary, including definitions of tables, views, and stored procedures needed by the database. Oracle Database automatically maintains information in this tablespace.</p>
</td>
</tr>
<tr align="left" valign="top">
<td id="r3c1-t4" headers="r1c1-t4" align="left">
<p><code>SYSAUX</code><a id="sthref401" name="sthref401"></a><a id="sthref402" name="sthref402"></a></p>
</td>
<td headers="r3c1-t4 r1c2-t4" align="left">
<p>A mandatory, auxiliary system tablespace that is used by many Oracle Database features and products. This tablespace contains content that was previously stored in the <code>DRSYS</code>, <code>CWMLITE</code>, <code>XDB</code>, <code>ODM</code>, <code>OEM_REPOSITORY</code>, and <code>SYSTEM</code> tablespaces.</p>
</td>
</tr>
<tr align="left" valign="top">
<td id="r4c1-t4" headers="r1c1-t4" align="left">
<p><code>USERS<a id="sthref403" name="sthref403"></a><a id="sthref404" name="sthref404"></a></code></p>
</td>
<td headers="r4c1-t4 r1c2-t4" align="left">
<p>An user-created tablespace that consists of application data. As you create and enter data into tables, Oracle Database fills this space with your data.</p>
</td>
</tr>
<tr align="left" valign="top">
<td id="r5c1-t4" headers="r1c1-t4" align="left">
<p><code>TEMP</code> <a id="sthref405" name="sthref405"></a><a id="sthref406" name="sthref406"></a><a id="sthref407" name="sthref407"></a></p>
</td>
<td headers="r5c1-t4 r1c2-t4" align="left">
<p>A mandatory tablespace that contains temporary tables and indexes created during SQL statement processing. You may have to expand this tablespace if you run SQL statements that involve significant sorting, such as <code>ANALYZE COMPUTE STATISTICS</code> on a very large table, or the constructs <code>GROUP BY</code>, <code>ORDER</code> <code>BY</code>, or <code>DISTINCT</code>.</p>
</td>
</tr>
<tr align="left" valign="top">
<td id="r6c1-t4" headers="r1c1-t4" align="left">
<p><code>UNDOTBS<a id="sthref408" name="sthref408"></a><a id="sthref409" name="sthref409"></a></code><span class="italic">n</span></p>
</td>
<td headers="r6c1-t4 r1c2-t4" align="left">
<p>System-managed tablespaces that contain undo data for each instance. Each Oracle RAC instance uses a different value for <span class="italic">n</span> in the tablespace name. These tablespaces are used for automatic undo management.</p>
</td>
</tr>
<tr align="left" valign="top">
<td id="r7c1-t4" headers="r1c1-t4" align="left">
<p><code>RBS<a id="sthref410" name="sthref410"></a><a id="sthref411" name="sthref411"></a></code></p>
</td>
<td headers="r7c1-t4 r1c2-t4" align="left">
<p>A system tablespace that contains rollback segments. If you do not use automatic undo management, then you must configure the <code>RBS</code> tablespace. The <code>RBS</code> tablespace should only be used when needed for compatibility with earlier versions of Oracle Database.</p>
</td>
</tr>
</tbody>
</table>




<br/><br/>
Посмотреть, какие табличные пространства имеются в базе данных можно следующим запросом.


<pre class="brush: sql;">
SQL> select TABLESPACE_NAME from dba_tablespaces;
</pre>

<pre>

SYSTEM
SYSAUX
UNDOTBS1
TEMP
USERS
MY_DATA
MY_INDEXES
MY_TEMP

8 rows selected.
</pre>

<br/><br/>
В каких файла хранятся табличные пространства.<br/>
select file_name, tablespace_name FROM DBA_DATA_FILES;
<br/><br/>


<h3>Табличное пространство system</h3>

В табличном пространстве system хранится «Словарь данных Oracle»

<br/><br/>

Каждая база данных Oracle содержит набор таблиц, доступных только для чтения и известных как словарь данных (data dictionary), который содержит метаданные (информацию о различных компонентах базы данных). Словарь данных Oracle – сердце системы управления базой данных.
Словарь данных создается при создании экземпляра базы данных выполнением инструкций в файле $ORACLE_HOME/rdbms/admin/catalog.sql

<br/><br/>
Oracle не позволяет обращаться к таблицам словаря данных напрямую. Он создает представления на базе этих таблиц и общедоступные синонины для тих представлений, к которым могут обращаться пользователи. Существует три набора представлений словаря данных: USER, ALL и DBA – каждый из которых содержит сходный набор представлений со сходным набором столбцов. 
<br/><br/>

<br/><br/>
select * from dictionary;

<br/><br/>

<strong>Посмотреть содержимое табличного пространства system</strong>

<br/><br/>
<pre class="brush: sql;">
	select segment_name,owner, sum(bytes) from dba_segments where tablespace_name = 'SYSTEM'  group by segment_name, owner order by 3,2 desc;
</pre>

<br/><br/>
<br/><br/>
<h3>Табличное пространство sysaux</h3>
Табличное пространство sysaux служит вспомогательным табличным пространством по отношению к табличному пространству system. 

<br/><br/>

<pre class="brush: sql;">
SQL> set pagesize 0;
SQL> set linesize 200;

SQL> select occupant_desc,space_usage_kbytes from V$SYSAUX_OCCUPANTS order by space_usage_kbytes;

</pre>

<br/><br/>

<pre>

Server Manageability - Automatic Workload Repository                         679360
Unified Job Scheduler                                                        204992
Server Manageability - Advisor Framework                                     145600
Server Manageability - Optimizer Statistics History                           90944
XDB                                                                           60096
Oracle Spatial                                                                48704
Oracle Multimedia ORDDATA Components                                          15616
LogMiner                                                                      12544
Server Manageability - Other Components                                        7744
Workspace Manager                                                              7488
PL/SQL Identifier Collection                                                   5568
Transaction Layer - SCN to TIME mapping                                        5376
Expression Filter System                                                       3968
Enterprise Manager Monitoring User                                             1920
SQL Management Base Schema                                                     1728
OLAP API History Tables                                                        1536
Analytical Workspace Object Table                                              1536
Logical Standby                                                                1408
Oracle Streams                                                                 1024
Oracle Multimedia ORDSYS Components                                             576
Automated Maintenance Tasks                                                     320
Enterprise Manager Repository                                                     0
Oracle Text                                                                       0
Oracle Ultra Search                                                               0
OLAP Catalog                                                                      0
DB audit tables                                                                   0
Oracle Transparent Session Migration User                                         0
Oracle Multimedia SI_INFORMTN_SCHEMA Components                                   0
Oracle Multimedia ORDPLUGINS Components                                           0
Statspack Repository                                                              0
Oracle Ultra Search Demo User                                                     0

31 rows selected.

</pre>
<br/><br/>

Табличное пространство USERS – табличное пространство, где по умолчанию хранятся пользовательские данные.

<br/><br/>

Табличное пространство UNDO служит для хранения данных отмены, которые используются для возврата измененных данных в исходное состояние.

<br/><br/>

Табличное пространство TEMP – служит для хранения объектов, существующих на протяжении существования пользовательского сеанса.

<br/><br/>

Остальные табличные пространства MY_DATA, MY_INDEXES, MY_TEMP – созданы исключительно для удобства.


<br/><br/>
<h2>Размер и свободное место для всех табличных пространств</h2>
<br/><br/>
<pre class="brush: sql;">
    SELECT a.tablespace_name, "Free, MB", "Total, MB" FROM
      (SELECT tablespace_name, ROUND(SUM(bytes)/1024/1024) AS "Total, MB" FROM dba_data_files GROUP BY tablespace_name
      UNION
      SELECT tablespace_name, ROUND(SUM(bytes)/1024/1024) AS "Total, MB" FROM dba_temp_files GROUP BY tablespace_name) a,
      (SELECT tablespace_name, ROUND(SUM(bytes)/1024/1024) AS "Free, MB" FROM dba_free_space GROUP BY tablespace_name) b
    WHERE a.tablespace_name = b.tablespace_name (+)
    ORDER BY a.tablespace_name;
</pre>


<br/><br/>
<strong>Result:</strong>

<br/><br/>
<pre>
TABLESPACE_NAME                  Free, MB  Total, MB
------------------------------ ---------- ----------
MY_DATA                              2046       2048
MY_INDEXES                           2047       2048
MY_TEMP                                         2048
SYSAUX                                 56        820
SYSTEM                                  1        750
TEMP                                              54
UNDOTBS1                               39         75
USERS                                   4          5

8 rows selected.
</pre>

<br/>
<br/>
Или такой вариант:
<br/>
<br/>

<pre class="brush: sql;">

select 	a.TABLESPACE_NAME tablespace_name, b.BYTES total_bytes, a.BYTES free_bytes,
        round(a.BYTES*100/b.BYTES,2) percent_free,
        round((b.BYTES-a.BYTES)*100/b.BYTES,2) percent_used
from  (select TABLESPACE_NAME, sum(BYTES) BYTES from dba_free_space group by TABLESPACE_NAME) a,
      (select TABLESPACE_NAME, sum(BYTES) BYTES from dba_data_files group by TABLESPACE_NAME) b
where a.TABLESPACE_NAME=b.TABLESPACE_NAME
order by a.TABLESPACE_NAME;

</pre>


<br/>
<br/>

<pre>

TABLESPACE_NAME                TOTAL_BYTES FREE_BYTES PERCENT_FREE PERCENT_USED
------------------------------ ----------- ---------- ------------ ------------
MY_DATA                         9674162176 9663217664        99.89          .11
MY_DATA2                        1073741824 1072693248         99.9           .1
MY_INDEXES                      2147483648 2146369536        99.95          .05
SYSAUX                           891289600   62717952         7.04        92.96
SYSTEM                           807403520    1900544          .24        99.76
UNDOTBS1                          78643200   63700992           81           19
USERS                              5242880    2228224         42.5         57.5

7 rows selected.

</pre>




<br/><br/>
<h2>Размер и свободное место для временных табличных пространств<h/2>
</h2>
<br/><br/>

<pre class="brush: sql;">
    SELECT a.tablespace_name, total_bytes/1024/1024 AS "Total, MB", used_mbytes AS "Used, MB",
      (total_bytes/1024/1024 - used_mbytes) AS "Free, MB" FROM
        (SELECT tablespace_name, SUM(bytes_used + bytes_free) AS total_bytes
          FROM v$temp_space_header GROUP BY tablespace_name) a,
        (SELECT tablespace_name, used_blocks*8/1024 AS used_mbytes FROM v$sort_segment) b
    WHERE a.tablespace_name=b.tablespace_name;
</pre>

<br/><br/>
<strong>Result:</strong>

<br/><br/>
<pre>
TABLESPACE_NAME                  Total, MB   Used, MB   Free, MB
------------------------------- ---------- ---------- ----------
TEMP                                    54          0         54
MY_TEMP                               2048          0       2048
</pre>




</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
