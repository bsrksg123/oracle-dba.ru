<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Копирование дистрибутивов базы данных на сервер</h2>


<pre>

Необходимо скопировать следующие архивы на сервер (в каталог /tmp):

p10404530_112030_Linux-x86-64_1of7.zip
p10404530_112030_Linux-x86-64_2of7.zip
p10404530_112030_Linux-x86-64_3of7.zip


scp marley@192.168.1.5:/mnt/dsk2/_ISO/oracle/linux/11.2.0.3.0/p10404530_112030_Linux-x86-64_{1..3}of7.zip /tmp/

# chown -R oracle11:oinstall /tmp/p10404530_112030_Linux-x86-64_*

</pre>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
