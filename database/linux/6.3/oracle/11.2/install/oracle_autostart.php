<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Автоматизация автозапуска Oracle после перезагрузки:</h2>

<br/><br/>


<pre>		

$ vi /etc/oratab

ora112:/u01/oracle/database/11.2:N

заменить на 

# ora112:/u01/oracle/database/11.2:N
ora112:/u01/oracle/database/11.2:Y




Создание скрипта, стартующего и останавливающего базу данных при старте и перезапуске операционной системы:

Создайте скрипт для запуска базы данных следующего содержания.

# vi /etc/rc.d/init.d/startupOracleDatabase11GR2

#!/bin/bash
#
# chkconfig: 35 98 03
# description: Oracle 11gR2 startup and shutdown script

# source function library
. /etc/rc.d/init.d/functions

ORA_SCRIPTS=/u01/oracle/database/11.2/bin
ORA_OWNER=oracle11

echo "-------------------------------------------------" >> /var/log/ora112.log
date >> /var/log/ora112.log
       
start() {
       if [ -x $ORA_SCRIPTS/dbstart ]; then
           echo -n "Starting Oracle 11gR2 databases: "
           su - $ORA_OWNER -c "$ORA_SCRIPTS/dbstart" >> /var/log/ora112.log
           echo_success
           echo
           echo -n "Starting Oracle 11gR2 TNS listener: "
           su - $ORA_OWNER -c "$ORA_SCRIPTS/lsnrctl start" >> /var/log/ora112.log
		   echo_success
		   touch /var/lock/subsys/ora112.log
		   echo 
		   echo -n "Starting Oracle Enterprise Manager 11g Database Control: "
           su - $ORA_OWNER -c "$ORA_SCRIPTS/emctl start dbconsole" >> /var/log/ora112.log
           echo_success
           echo
           exit 0
       else
           echo -n "Starting Oracle 11gR2 databases: "
           echo_failed
           echo
           exit 1;
       fi
}

stop()  {
       if [ -x $ORA_SCRIPTS/dbshut ]; then
	       echo -n "Stopping Oracle Enterprise Manager 11g Database Control: "
           su - $ORA_OWNER -c "$ORA_SCRIPTS/emctl stop dbconsole" >> /var/log/ora112.log
           echo_success
           echo
           echo -n "Stoping Oracle 11gR2 TNS listener: "
           su - $ORA_OWNER -c "$ORA_SCRIPTS/lsnrctl stop" >> /var/log/ora112.log
           echo_success
           echo
           echo -n "Stoping Oracle 11gR2 databases: "
           su - $ORA_OWNER -c $ORA_SCRIPTS/dbshut >> /var/log/ora112.log
           echo_success
           echo
           rm -f /var/lock/subsys/ora112.log
           exit 0
       else
           echo -n "Stoping Oracle 11gR2 databases: "
           echo_failed
           echo
           exit 1;
       fi
}


case "$1" in
 start)
       start
       ;;
 stop)
       stop
       ;;
 *)
       echo $"Usage: $0 {start|stop}"
       exit 1
esac

exit 0



# chmod +x /etc/rc.d/init.d/startupOracleDatabase11GR2
# chkconfig --add startupOracleDatabase11GR2
# chkconfig --level 345 startupOracleDatabase11GR2 on

</pre>		

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
