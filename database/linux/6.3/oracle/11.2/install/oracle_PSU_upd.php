<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Обновление базы патчами, рекомендованными Oracle</h2>

<br/><br/>

<pre>

Если у вас имеется активный контракд для доступа на support.oracle.com, вы можете
скачать последние обновления для продуктов Oracle и при необходимости сделать запрос в тех поддержку, в т.ч.
на выпуск каких-нибудь заплаток. Особенно актуально это было в период, когда менялись часовые пояся из за
распоряжения Президента.

На одной из закладок, Oracle показывает, какие патчи он рекомендует применить.

</pre>

<br/><br/>

<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_01.PNG" border="0" alt="Oracle Patches"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_02.PNG" border="0" alt="Oracle Patches"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_03.PNG" border="0" alt="Oracle Patches"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_04.PNG" border="0" alt="Oracle Patches"><br/><br/>



<br/><br/>

<pre>

Перед примененением, рекомендуется обновить саму систему обновления патчей, которая называется OPatch.
Сам OPatch имеет свой внутренний код 6880880 и доступен для скачивания:

https://updates.oracle.com/ARULink/PatchDetails/process_form?patch_num=6880880
</pre>

<br/><br/>


<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_05.PNG" border="0" alt="Oracle Patches"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/OraclePatches_06.PNG" border="0" alt="Oracle Patches"><br/><br/>



<pre>	

Установка нового OPatch

$ rm -rf /u01/oracle/database/11.2/OPatch/
$ unzip p6880880_112000_Linux-x86-64.zip
$ mv OPatch/ /u01/oracle/database/11.2
$ cd /u01/oracle/database/11.2/OPatch

$ ./opatch version
OPatch Version: 11.2.0.3.0

OPatch succeeded.




================================================


2) Применение патча 1
$ sqlplus / as sysdba
SQL> shutdown immediate;
SQL> quit

$ cd /tmp

$ export PATH=$PATH:/u01/oracle/database/11.2/OPatch
$ unzip p13632717_112030_Linux-x86-64.zip
$ cd 13632717/
$ opatch napply -skip_subset -skip_duplicate

....
OPatch succeeded.




cd $ORACLE_HOME/rdbms/admin
$ sqlplus / as sysdba
SQL> startup
SQL> @catbundle.sql cpu apply
SQL> QUIT



------------------------------------------------------------------------------------------

3) Применение патча 2

$ sqlplus / as sysdba
SQL> shutdown immediate;
SQL> quit

$ cd /tmp


$ unzip p13696216_112030_Linux-x86-64.zip
$ cd 13696216
$ opatch prereq CheckConflictAgainstOHWithDetail -ph ./

OPatch succeeded.

$ opatch apply
***
OPatch completed with warnings.


$ cd $ORACLE_HOME/rdbms/admin
$ sqlplus / as sysdba
SQL> startup
SQL> @catbundle.sql psu apply
SQL> QUIT

</pre>	

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
