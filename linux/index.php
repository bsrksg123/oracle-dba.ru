<html>

<?php include_once "../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../_pagenav.php"?>



<br/><br/><br/>
<h2>Некоторые команды Linux: </h2>

<br/><br/>

<pre>
Отсортировать файлы по размеру:
$ ls -s | sort -n


Создать архив zip:
for i in $(find ./logs/ -name "*") ;do zip ./weblogic_logs.zip $i; done 


Создать tar.gz:
tar -cvzpf FileName.tar.gz ./file_dir

Извлечь tar.gz:
tar -xvzpf FileName.tar.gz ./


Извлечь tar.bz2:
tar jxf FileName.tar.bz2


Извлечь tar:
tar xvf FileName.tar -C ./


Извлечь .tgz:
tar xf FileName.tgz -C ./ 


Найти рекурсивно файлы размером более 100 Мб
find . -size +100000k -exec du -h {} \;

<!--
Какие порты используются приложениями:
ps -ef | grep java | grep "netcracker/config" | sed 's/^[a-zA-Z]\{1,\}[[:space:]]*\([0-9]\{1,5\}\).*\(\-Xmx[0-9]*m\).*t3.\{3\}\([a-zA-Z\.0-9]*:[0-9]\{4\}\)[[:space:]].*\-Dnetcracker\.home=\([^[:space:]]\{1,\}\).*$/\1\t\2\t\3\t\4/' | sort

-->

</pre>

</div>		
		
	

<?php include_once "../_footer.php"?>

</body>

</html>
