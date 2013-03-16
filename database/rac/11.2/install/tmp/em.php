<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>

A default Super Administrator account, SYSMAN, is created with the password you specified during the installation. After installation, you can immediately log in to the Grid Control Console with this user name and password to perform management tasks. The SYSMAN account owns the database schema containing the Management Repository. 

<br/><br/><br/>
<h1>Oracle RAC 11G R2:</h1>
<br/><br/>
Oracle® Database Utilities
11g Release 2 (11.2)
Enterprise Manager Configuration Assistant (EMCA)
http://docs.oracle.com/cd/E14072_01/server.112/e10701/emca.htm


$ srvctl start listener -n node1


sqlplus - show parameter job_queue_processes
 alter system set job_queue_processes=1 scope=both;
 
 
 

 
 --------------------------------------------------
 
 Listener Parameter File   /u01/app/grid/11.2/network/admin/listener.ora
Listener Log File         /u01/app/oracle/diag/tnslsnr/node1/listener/alert/log.xml


 
 
 $ srvctl status listener
Listener LISTENER is enabled
Listener LISTENER is running on node(s): node2,node1

export ORACLE_HOME=/u01/app/oracle/product/grid/11.2/software




$ emca -config dbcontrol db -respFile restFile


SID=racnode1
PORT=1521
LISTENER_OH=/u01/app/oracle/product/grid/11.2/software
DBSNMP_PWD=dbsnmp
ASM_OH=/u01/app/oracle/product/grid/11.2/software
ASM_SID=+ASM 
ASM_PORT=1521
ASM_USER_NAME=ASMSNMP
ASM_USER_PWD=Fgjrfkbgcbc
	--------------------------------------------------
	
	1) Command to drop the existing configuration
$ emca -deconfig dbcontrol db -repos drop
	
	2) Create the OEM GRID repository
	emca -repos create 
	
	3) Confitgure EM Grid control
	$ emca -config dbcontrol db
	
	
	4) emctl status dbconsole
	
	
	--------------------------------------------------
	
	
	
	emca -displayConfig dbcontrol -cluster

emca -deconfig dbcontrol db -repos drop -cluster -respFile respFile.txt

resFile.txt
DB_UNIQUE_NAME=racnode1
SERVICE_NAME=racnode
PORT=1521
LISTENER_OH=/u01/app/grid/11.2/crs
SYS_PWD=Fgjrfkbgcbc
SYSMAN_PWD=Fgjrfkbgcbc

emca -config dbcontrol db -repos create -cluster -respFile respFile.txt




vi restFile

DB_UNIQUE_NAME=racnode
SERVICE_NAME=racnode
PORT=1521
LISTENER_OH=/u01/app/oracle/product/grid/11.2/software/crs
SYS_PWD=Fgjrfkbgcbc11
SYSMAN_PWD=Fgjrfkbgcbc11







ASM ORACLE_HOME ................ /u01/app/oracle/product/grid/11.2/software
/u01/app/oracle/product/grid/11.2/config


emctl stop dbconsole


emctl start dbconsole 

$ find ./ -name jcb.jar








	
	emca -config dbcontrol db
	
	
	
	СКОРЕЕ ВСЕГО create
	[oracle11@node1 ~]$ emca -repos recreate

STARTED EMCA at May 26, 2012 2:18:02 AM
EM Configuration Assistant, Version 11.2.0.3.0 Production
Copyright (c) 2003, 2011, Oracle.  All rights reserved.

Enter the following information:
Database SID: racnode1
Listener port number: 1521
Password for SYS user:
Password for SYSMAN user:

----------------------------------------------------------------------
WARNING : While repository is dropped the database will be put in quiesce mode.
----------------------------------------------------------------------
Do you wish to continue? [yes(Y)/no(N)]: y
May 26, 2012 2:18:31 AM oracle.sysman.emcp.EMConfig perform
INFO: This operation is being logged at /u01/app/oracle/product/database/11.2/config/cfgtoollogs/emca/racnode/emca_2012_05_26_02_18_01.log.
May 26, 2012 2:18:32 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Dropping the EM repository (this may take a while) ...
May 26, 2012 2:18:34 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Repository successfully dropped
May 26, 2012 2:18:35 AM oracle.sysman.emcp.EMReposConfig createRepository
INFO: Creating the EM repository (this may take a while) ...

	
	
	
	
	
	
	
	
	For configuring Enterprise Manager for a new cluster instance of a database or ASM storage, use the following command
	emca -addInst db
	
	For information on the current cluster configuration, you can run:
	emca -displayConfig dbcontrol –cluster
	
	Нужно попробовать!!! ХЗ что за сервиснейм с ошибкамию
	emca -repos recreate -cluster 
	
	$ emca -repos recreate

STARTED EMCA at May 26, 2012 2:18:02 AM
EM Configuration Assistant, Version 11.2.0.3.0 Production
Copyright (c) 2003, 2011, Oracle.  All rights reserved.

Enter the following information:
Database SID: racnode1
Listener port number: 1521
Password for SYS user:
Password for SYSMAN user:

----------------------------------------------------------------------
WARNING : While repository is dropped the database will be put in quiesce mode.
----------------------------------------------------------------------
Do you wish to continue? [yes(Y)/no(N)]: y
May 26, 2012 2:18:31 AM oracle.sysman.emcp.EMConfig perform
INFO: This operation is being logged at /u01/app/oracle/product/database/11.2/config/cfgtoollogs/emca/racnode/emca_2012_05_26_02_18_01.log.
May 26, 2012 2:18:32 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Dropping the EM repository (this may take a while) ...
May 26, 2012 2:18:34 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Repository successfully dropped
May 26, 2012 2:18:35 AM oracle.sysman.emcp.EMReposConfig createRepository
INFO: Creating the EM repository (this may take a while) ...
May 26, 2012 2:29:19 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Repository successfully created
Enterprise Manager configuration completed successfully
FINISHED EMCA at May 26, 2012 2:29:19 AM


SQL> alter user dbsnmp account unlock;
SQL> alter user dbsnmp identified by dbsnmp;

emca -config dbcontrol db 

	
	
	
	
	 emca -config dbcontrol db

STARTED EMCA at May 26, 2012 2:34:29 AM
EM Configuration Assistant, Version 11.2.0.3.0 Production
Copyright (c) 2003, 2011, Oracle.  All rights reserved.

Enter the following information:
Database SID: racnode1
Listener port number: 1521
Listener ORACLE_HOME [ /u01/app/oracle/product/database/11.2/software ]: 
Password for SYS user:
Password for DBSNMP user:  bsnmplter user dbsnmp identified by dbsnmp;
May 26, 2012 2:37:42 AM oracle.sysman.emcp.util.GeneralUtil initSQLEngineLoacly
WARNING: ORA-01017: invalid username/password; logon denied

May 26, 2012 2:37:43 AM oracle.sysman.emcp.util.GeneralUtil initSQLEngineLoacly
WARNING: ORA-01017: invalid username/password; logon denied

Invalid username/password.
Password for DBSNMP user: [oracle11@node1 ~]$
[oracle11@node1 ~]$ emca -config dbcontrol db

STARTED EMCA at May 26, 2012 2:37:49 AM
EM Configuration Assistant, Version 11.2.0.3.0 Production
Copyright (c) 2003, 2011, Oracle.  All rights reserved.

Enter the following information:
Database SID: racnode1
Listener port number: 1521
Listener ORACLE_HOME [ /u01/app/oracle/product/database/11.2/software ]: /u01/app/oracle/product/grid/11.2/software
Password for SYS user:
Password for DBSNMP user:
Password for SYSMAN user:
Email address for notifications (optional):
Outgoing Mail (SMTP) server for notifications (optional):
ASM ORACLE_HOME [ /u01/app/oracle/product/database/11.2/software ]: /u01/app/oracle/product/grid/11.2/software/
ASM SID [ +ASM ]:
ASM port [ 1521 ]:
ASM username [ ASMSNMP ]:
ASM user password:
ASM user password: -----------------------------------------------------------------

You have specified the following settings

Database ORACLE_HOME ................ /u01/app/oracle/product/database/11.2/software

Local hostname ................ node1.localdomain
Listener ORACLE_HOME ................ /u01/app/oracle/product/grid/11.2/software
Listener port number ................ 1521
Database SID ................ racnode1
Email address for notifications ...............
Outgoing Mail (SMTP) server for notifications ...............
ASM ORACLE_HOME ................ /u01/app/oracle/product/grid/11.2/software/
ASM SID ................ +ASM
ASM port ................ 1521
ASM user role ................ SYSDBA
ASM username ................ ASMSNMP

-----------------------------------------------------------------
Do you wish to continue? [yes(Y)/no(N)]: y
May 26, 2012 2:39:52 AM oracle.sysman.emcp.EMConfig perform
INFO: This operation is being logged at /u01/app/oracle/product/database/11.2/config/cfgtoollogs/emca/racnode/emca_2012_05_26_02_37_48.log.
May 26, 2012 2:39:59 AM oracle.sysman.emcp.EMReposConfig uploadConfigDataToRepository
INFO: Uploading configuration data to EM repository (this may take a while) ...
May 26, 2012 2:41:39 AM oracle.sysman.emcp.EMReposConfig invoke
INFO: Uploaded configuration data successfully
May 26, 2012 2:41:41 AM oracle.sysman.emcp.ParamsManager getLocalListener
WARNING: Error retrieving listener for node1.localdomain
May 26, 2012 2:41:43 AM oracle.sysman.emcp.util.DBControlUtil secureDBConsole
INFO: Securing Database Control (this may take a while) ...
May 26, 2012 2:41:55 AM oracle.sysman.emcp.util.DBControlUtil secureDBConsole
INFO: Database Control secured successfully.
May 26, 2012 2:41:55 AM oracle.sysman.emcp.util.DBControlUtil startOMS
INFO: Starting Database Control (this may take a while) ...
May 26, 2012 2:43:11 AM oracle.sysman.emcp.EMDBPostConfig performConfiguration
INFO: Database Control started successfully
May 26, 2012 2:43:11 AM oracle.sysman.emcp.EMDBPostConfig performConfiguration
INFO: >>>>>>>>>>> The Database Control URL is https://node1.localdomain:1158/em <<<<<<<<<<<
May 26, 2012 2:43:15 AM oracle.sysman.emcp.EMDBPostConfig invoke
WARNING:
************************  WARNING  ************************

Management Repository has been placed in secure mode wherein Enterprise Manager data will be encrypted.  The encryption key has been placed in the file: /u01/app/oracle/product/database/11.2/software/node1_racnode/sysman/config/emkey.ora. Ensure this file is backed up as the encrypted data will become unusable if this file is lost.

***********************************************************
Enterprise Manager configuration completed successfully
FINISHED EMCA at May 26, 2012 2:43:15 AM

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
