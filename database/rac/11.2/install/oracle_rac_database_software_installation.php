<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Инсталляция Database Software</h2>

<pre>


$ cd /tmp/database
$ ./runInstaller

</pre>
<br/><br/>

<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_01.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_02.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_03.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_04.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_05.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_06.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_07.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_08.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_09.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_10.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_11.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/rac_database_software_installation_12.PNG" border="0" alt="Oracle RAC installation"><br/><br/>


<pre>

node1

# /u01/app/oracle/product/rac/11.2/root.sh
Performing root user operation for Oracle 11g

The following environment variables are set as:
    ORACLE_OWNER= oracle11
    ORACLE_HOME=  /u01/app/oracle/product/rac/11.2

Enter the full pathname of the local bin directory: [/usr/local/bin]:
The contents of "dbhome" have not changed. No need to overwrite.
The contents of "oraenv" have not changed. No need to overwrite.
The contents of "coraenv" have not changed. No need to overwrite.

Entries will be added to the /etc/oratab file as needed by
Database Configuration Assistant when a database is created
Finished running generic part of root script.
Now product-specific root actions will be performed.
Finished product-specific root actions.






# /u01/app/oracle/product/rac/11.2/root.sh
Performing root user operation for Oracle 11g

The following environment variables are set as:
    ORACLE_OWNER= oracle11
    ORACLE_HOME=  /u01/app/oracle/product/rac/11.2

Enter the full pathname of the local bin directory: [/usr/local/bin]:
The contents of "dbhome" have not changed. No need to overwrite.
The contents of "oraenv" have not changed. No need to overwrite.
The contents of "coraenv" have not changed. No need to overwrite.

Entries will be added to the /etc/oratab file as needed by
Database Configuration Assistant when a database is created
Finished running generic part of root script.
Now product-specific root actions will be performed.
Finished product-specific root actions.






 
$ olsnodes
node1
node2
 
node_name -- displays information for the particular node

g -- more details
i -- with VIP
l -- local node name
n -- with node number
p -- private interconnect
s -- status of the node (ACTIVE or INACTIVE)
t -- type of the node (PINNED or UNPINNED)
v -- verbose

Разработчики в своих скриптах жестко закодили путь olsnodes.
Если olsnodes не будет найден в каталоге /u01/app/grid/11.2/crs, развертывание Enterprise Manager закончится ошибкой.
На поиск причин, почему при инсталляции валится EM, у меня ушло около суток. Надеюсь это кому-нибудь поможет.



На обоих нодах:
# cp /u01/app/grid/11.2/bin/olsnodes /u01/app/grid/11.2/crs
# chown oracle11:dba /u01/app/grid/11.2/crs/olsnodes



</pre>


<pre>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
