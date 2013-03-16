<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Инсталляция базы данных Oracle (11.2.0.3) в операционной системе Oracle Linux (6.3 x86_64 bit):</h2><br/>

<ul>
<li><a href="vitrualBox_installation_on_ubuntu.php"><strong>Инсталляция VirtualBox в операционной системе Ubuntu в консоли</strong></a></li>
<li><a href="vm_vitrualBox_for_oracle_installation.php"><strong>Подготовка окружения (виртуальной машины VirtualBox) для инсталляции базы данных Oracle 11G R2</strong></a></li>
<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/database/linux/6.3/oracle/11.2/install/">Инсталляция Oracle DataBase Server (11.2.0.3) в операционной системе Oracle Linux (6.3 x86_64)</a></li>
<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/How_to_Install_Oracle_Client_11gR2_on_Windows.php">Инсталляция Oracle Client 11G R2 32 bit в операционной системе Windows XP 32 bit</a></li>
</ul>

<br/>
<br/>

<strong>Дополнительно:</strong>
<br/>
<br/>

ASM - более "правильный" способ подготовки окружения Oracle. "Сырые" (RAW) жесткие диски объединяются в пулы специальными средствами Oracle. Более того, создается дополнительный экземпляр Oracle, инсталлируется GRID, появляются дополнительные возможности. Администрирование несколько усложняется. Лично мне, не приходилось плотно работать с окружением, где бы использовался ASM (поэтому может чего и не знаю), но приходилось устанавливать  (установил, отдал и забыл) и настраивать ASM в окружении для RAC.
<br/>
<br/>

<ul>

<li><a href="https://docs.google.com/document/d/1iGmRtwwcC9FGESnlR7v5qrcLKOzGIoh1GNeU5N0Q5cQ/edit">Инсталляция Oracle DataBase 11G R2 x86 64 bit в операционной системе Oracle Linux 5.7 x86 64 bit (ASM)</a></li>

</ul>

<br/><br/>
<h2>Инсталляция базы данных Oracle в операционной системе Oracle Linux x86_64 bit (Предыдущие документы):</h2><br/>

<ul>
	<li><a href="Oracle_Linux_Installation.php"><strong>Инсталляция Oracle Linux 5.8 x86 64 bit</strong></a></li>
	<li><a href="How_to_Install_Oracle_DataBase_11gR2_on_Remote_Oracle_Enterprise_Linux_Server.php"><strong>Инсталляция Oracle DataBase 11G R2 x86 64 bit в операционной системе Oracle Linux 5.8 x86 64 bit</strong></a> </li>
</ul>


<br/><br/><br/>
<h3>Инсталляция базы данных Oracle в других операционных системах:</h3><br/>

	
<ul>
	<li><a href="http://odba.ru/showthread.php?t=303"><strong>Инсталляция Oracle Database 11g Release 2 в операционной системе Windows</strong></a> </li>
	<li><a href="http://odba.ru/showthread.php?t=303"><strong>Инсталляция Oracle Database 11g Release 2 в Oracle Solaris 10</strong></a> </li>
</ul>



<br/><br/><br/>
<h3>Инсталляция бесплатных версий баз данных Oracle:</h3><br/>	

<ul>
	<li><a href="http://odba.ru/showthread.php?t=742"><strong>Инструкция по инсталляции базы данных Oracle 11g XE на сервер Oracle Enterprise Linux 5.8</strong></a></li>
	<li><a href="http://odba.ru/showthread.php?t=400"><strong>Инструкция по инсталляции базы данных Oracle 10g XE на сервер Oracle Enterprise Linux 4.8</strong></a></li>
	<li><a href="http://odba.ru/showthread.php?t=296"><strong>Инсталляция Oracle Database 10g Express Edition в ОС Windows 2003 Server </strong></a></li>
	
	
</ul>

	
	
	


</div>
<br/><br/><br/>



</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
