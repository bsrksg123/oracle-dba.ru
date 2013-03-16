<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Проверка конфигурации кластера перед инсталляцией RAC</h2>


<pre>

Скачайте с сайта oracle последнюю версию «Oracle Cluster Verification Utility»
http://www.oracle.com/technetwork/database/clustering/downloads/cvu-download-homepage-099973.html



</pre>

<span style="font-size: 20px; text-align: left; line-height: 130%; font-family: Arial,Helvetica,sans-serif; color: rgb(153, 0, 0);">
<strong>Инсталляция cvuqdisk-1.0.9-1.rpm</strong></span>

<br/><br/>

<table cellpadding="4" cellspacing="2" align="center" border="0" width="98%">  
<tbody> 
   
<tr>      
<td style="color: rgb(255, 255, 255);" bgcolor="#386351" width="14%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>Server:</strong></span></td>      
<td height="20" bgcolor="#a2bcb1" width="60%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>node1,node2</strong></span></td>      
<td rowspan="3" align="center" valign="middle" width="26%"></td>
</tr>

</table>

<pre>
Нужно установить пакет cvuqdisk-1.0.9-1.rpm на всех узлах кластера

Ранее, я скопировал данный пакет на один из серверов linux.
Забираю их следующей командой:

# scp marley@192.168.1.5:/mnt/dsk2/_ISO/oracle/linux/cvupack_Linux_x86_64.zip /tmp/

# cd /tmp

# mkdir cvupack
# mv cvupack_Linux_x86_64.zip ./cvupack
# cd /tmp/cvupack
# unzip cvupack_Linux_x86_64.zip

# rpm -Uvh /tmp/cvupack/rpm/cvuqdisk-1.0.9-1.rpm

# chown -R oracle11:oinstall /tmp/cvupack

</pre>


<span style="font-size: 20px; text-align: left; line-height: 130%; font-family: Arial,Helvetica,sans-serif; color: rgb(153, 0, 0);">
<strong>Проверка правильности конфигурации подготовленных узлов кластера</strong></span>


<table cellpadding="4" cellspacing="2" align="center" border="0" width="98%">  
<tbody> 

<br/><br/>
   
<tr>      
<td style="color: rgb(255, 255, 255);" bgcolor="#386351" width="14%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>Server:</strong></span></td>      
<td height="20" bgcolor="#a2bcb1" width="60%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>node1</strong></span></td>      
<td rowspan="3" align="center" valign="middle" width="26%"></td>
</tr>

</table>

<pre>

# su - oracle11

$ cd /tmp/cvupack/bin

$ ./cluvfy stage -pre crsinst -n node1,node2 
Если возникли ошибки, можно получить лог с более детальным отчетом о возникших проблемах:
$ ./cluvfy stage -pre crsinst -n node1,node2 -r 11gR2  -verbose

***

Check: Membership of user "oracle11" in group "oinstall" [as Primary]
  Node Name         User Exists   Group Exists  User in Group  Primary       Status
  ----------------  ------------  ------------  ------------  ------------  ------------
  devsp038          yes           yes           yes           no            failed
  devsp037          yes           yes           yes           no            failed
Result: Membership check for user "oracle11" in group "oinstall" [as Primary] failed

***

[oracle11@devsp037 bin]$ id
uid=502(oracle11) gid=500(dba) groups=500(dba),1003(oinstall)


# usermod -g oinstall oracle11
# usermod -G dba oracle11

# su - oracle11
$ id
uid=502(oracle11) gid=1003(oinstall) groups=500(dba),1003(oinstall)


Результатом проверки должна быть следующее сообщение. 
Pre-check for cluster services setup was successful.



Интересно следующее, в самой консоли, требуется, чтобы основная группа была dba.

Поэтому:

# usermod -g dba oracle11
# usermod -G oinstall oracle11

</pre>

</div>


<?php include_once "../../../../_footer.php"?>

</body>

</html>
