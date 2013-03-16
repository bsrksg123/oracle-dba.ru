<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>




<pre>
DOWNLOADS:

OPatch
https://updates.oracle.com/ARULink/PatchDetails/process_form?patch_num=6880880

GRID
https://updates.oracle.com/ARULink/PatchDetails/process_form?patch_num=13696251

</pre>

<br/><br/>

<div align="center">
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_patching_01.PNG" border="0">
</div>

<br/><br/>

<div align="center">
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_patching_01.PNG" border="0">
</div>

<br/><br/>

<div align="center">
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_patching_01.PNG" border="0">
</div>

<br/><br/>

<pre>

SQL> select comp_name,version,status from dba_registry;

select * from dba_registry_history;

SQL> select * from v$version;

BANNER
--------------------------------------------------------------------------------
Oracle Database 11g Enterprise Edition Release 11.2.0.3.0 - 64bit Production
PL/SQL Release 11.2.0.3.0 - Production
CORE    11.2.0.3.0      Production
TNS for Linux: Version 11.2.0.3.0 - Production
NLSRTL Version 11.2.0.3.0 - Production
----------------------------------
Сначала на узле 1

# rm -rf /u01/app/grid/11.2/OPatch
# rm -rf /u01/app/oracle/product/rac/11.2/OPatch
# unzip p6880880_112000_Linux-x86-64.zip

# cp -r OPatch /u01/app/grid/11.2
# cp -r OPatch /u01/app/oracle/product/rac/11.2


# chown -R oracle11:dba /u01/app/grid/11.2/OPatch
# chown -R oracle11:dba /u01/app/oracle/product/rac/11.2/OPatch

Проверка, что опатчи имеют версии 11.2.0.3.0

# su - oracle11 -c '/u01/app/grid/11.2/OPatch/opatch version -oh /u01/app/grid/11.2'
# su - oracle11 -c '/u01/app/oracle/product/rac/11.2/OPatch/opatch version -oh /u01/app/oracle/product/rac/11.2'


Validation of Oracle Inventory

# su - oracle11 -c '/u01/app/grid/11.2/OPatch/opatch lsinventory -detail -oh /u01/app/grid/11.2'
# su - oracle11 -c '/u01/app/oracle/product/rac/11.2/OPatch/opatch lsinventory -detail -oh /u01/app/oracle/product/rac/11.2'

Какие фиксы были

# su - oracle11 -c '/u01/app/grid/11.2/OPatch/opatch lsinventory -bugs_fixed -oh /u01/app/grid/11.2'
# su - oracle11 -c '/u01/app/oracle/product/rac/11.2/OPatch/opatch lsinventory -bugs_fixed -oh /u01/app/oracle/product/rac/11.2'


Проверка патчей:

# su - oracle11 -c '/u01/app/grid/11.2/OPatch/opatch prereq CheckConflictAgainstOHWithDetail -ph /u01/p/13696216 -oh /u01/app/grid/11.2'
# su - oracle11 -c '/u01/app/grid/11.2/OPatch/opatch prereq CheckConflictAgainstOHWithDetail -ph /u01/p/13696251 -oh /u01/app/grid/11.2'
# su - oracle11 -c '/u01/app/oracle/product/rac/11.2/OPatch/opatch prereq CheckConflictAgainstOHWithDetail -ph /u01/p/13696216 -oh /u01/app/oracle/product/rac/11.2'
# su - oracle11 -c '/u01/app/oracle/product/rac/11.2/OPatch/opatch prereq CheckConflictAgainstOHWithDetail -ph /u01/p/13696251 -oh /u01/app/oracle/product/rac/11.2'

----------------------------------------------
++++++++++++++++++++++++++++++++++++++++++



///////////////////////////////////////

su - oracle11

$ cd /u01/app/grid/11.2/OPatch/ocm/bin
./emocmrsp

$ cd /u01/app/oracle/product/rac/11.2/OPatch/ocm/bin/
./emocmrsp


//////////////////////////////////////
# cd /tmp/patches
# unzip p13696251_112030_Linux-x86-64.zip
# rm -rf p13696251_112030_Linux-x86-64.zip
# chown -R oracle11:dba ./

// PATCHING GRID_HOME

# /u01/app/grid/11.2/OPatch/opatch auto /tmp/patches -oh /u01/app/grid/11.2 -ocmrf /u01/app/grid/11.2/OPatch/ocm/bin/ocm.rsp

// PATCHING ORACLE_HOME

# /u01/app/oracle/product/rac/11.2/OPatch/opatch auto /tmp/patches -oh /u01/app/oracle/product/rac/11.2 -ocmrf /u01/app/oracle/product/rac/11.2/OPatch/ocm/bin/ocm.rsp





cd $ORACLE_HOME/rdbms/admin
sqlplus /nolog
SQL> CONNECT / AS SYSDBA
SQL> STARTUP
SQL> @catbundle.sql psu apply
SQL> QUIT



/u01/app/oracle/product/rac/11.2/OPatch/opatch lsinventory -bugs_fixed | egrep -i 'PSU|DATABASE PATCH SET UPDATE'




$ unzip p13696216_112030_Linux-x86-64.zip
$ cd 13696216
$ export PATH=$PATH:/u01/app/oracle/product/rac/11.2/OPatch
$ ./opatch prereq CheckConflictAgainstOHWithDetail -ph /u01/p/13696216



$ cd 13696216
$ export PATH=$PATH:/u01/app/oracle/product/rac/11.2/OPatch
$ opatch apply


[root@node1 p]# chown -R oracle11:dba ./
[root@node1 p]# chmod 766 -R ./









SQL> COL PRODUCT FORMAT A35
SQL> COL VERSION FORMAT A15
SQL> COL STATUS FORMAT A15
SQL> SELECT * FROM PRODUCT_COMPONENT_VERSION;

PRODUCT                             VERSION         STATUS
----------------------------------- --------------- ---------------
NLSRTL                              11.2.0.3.0      Production
Oracle Database 11g Enterprise Edit 11.2.0.3.0      64bit Productio
ion                                                 n

PL/SQL                              11.2.0.3.0      Production
TNS for Linux:                      11.2.0.3.0      Production


sql> SELECT * FROM dba_registry_history ORDER BY action_time DESC;

SQL> desc dba_registry_history;
 Name                                      Null?    Type
 ----------------------------------------- -------- ----------------------------
 ACTION_TIME                                        TIMESTAMP(6)
 ACTION                                             VARCHAR2(30)
 NAMESPACE                                          VARCHAR2(30)
 VERSION                                            VARCHAR2(30)
 ID                                                 NUMBER
 BUNDLE_SERIES                                      VARCHAR2(30)
 COMMENTS                                           VARCHAR2(255)

 
 
COL ACTION_TIME  FORMAT A10
COL ACTION FORMAT A30
COL NAMESPACE FORMAT A30
COL VERSION FORMAT A30
COL ID FORMAT A15
COL BUNDLE_SERIES FORMAT A30
COL COMMENTS A30



http://www.oracleportal.org/knowledge-base/oracle-database/database-concepts/installation-and-patching/patching/patches.aspx

</pre>

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
