<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: В конфигурации с использованием iSCSI и ASM</h2>
<br/><br/>
<strong>Oracle Real Application Clusters Installation Guide<br/>
11g Release 2 (11.2) for Linux and UNIX<br/></strong>
http://docs.oracle.com/cd/E11882_01/install.112/e24660/toc.htm

<br/><br/>
<br/><br/>

<div align="center">
<img src="http://img.oradba.net/img/oracle/database/rac/11.2/OracleRac_11.2.jpg" border="0">
</div>

<br/><br/>
<hr>
<br/><br/>

Ниже приведен пример развертывания <strong>Oracle Real Applicatoin Cluster 11.2 </strong> с использованием 4
виртуальных маши virtualbox, созданных "приблизительно" следующим образом:<br/>
https://docs.google.com/document/d/1ZU6Hk5DYitFYwlRFqN2qmJr6maPpvgsVc6ZTiZ1kYVA/edit

<br/><br/>
<br/><br/>

<div align="center">
	<img src="http://img.rodin-andrey.com/images/rac1.png" border="0">
</div>

<br/><br/>


<ul>
<li>2 виртуальные машины используются в качестве узлов кластера или кластерных нод (кому как больше нравится). На них устанавливается программное обеспечение Oracle: Oracle Grid и Oracle DataBase Software</li>
<li>1 виртуальная машина, которая выступает в роли хранилища данных, диски которого смонтированы в файловой системе узлов кластера по технологии iSCSI. </li>
<li>1 виртуальная машина используется в качестве DNS - сервера.</li>
</ul>


<br/><br/>
Каждый из узлов кластера имеет 4 GB оперативной памяти и 3 сетевых адаптера:<br/>
В качестве операционной системы выбран Oracle Linux 5.8
<br/><br/>

<ul>
	<li>eth0 – public</li>
	<li>eth1 – interconnect (для связи межу узлами кластера)</li>
	<li>eth2 – private (для связи узлов кластера с внешним хранилищем (storage))</li>
</ul>


<br/><br/>
<strong>Для инсталляции RAC, необходимо в одной подсети выделить IP адреса:</strong>
<br/><br/>

<ul>
	<li>1 public IP для каждого узла (просто для того, чтобы подключиться к серверу и выполнять задачи по администрированию)</li>
	<li>1 vip IP для каждого узла ((в той же подсети, что и public) желательно, чтобы vip были прописаны в DNS)</li>
	<li>3 IP адреса для SCAN ((в той же подсети, что и public) обязательно должны быть прописаны в DNS (иначе возникнут ошибки при инсталляции). Клиент обращается к SCAN адресу, который перенаправляет запрос на поднятый на узле кластера vip адрес)</li>
</ul>


<br/><br/>
<h2>Дистрибутивы:</h2>


<ul>
	<li><a href="oracle_rac_distrib.php">Дистрибутивы баз данных и дополнительное программное обеспечение</a><br/></li>
</ul>	
	
<br/><br/>
	
<h2>Подготовка окружения для инсталляции RAC:</h2>	

	
<ul>	
	<li><a href="oracle_rac_prev.php">Предварительные настройки</a><br/></li>
	<li><a href="oracle_rac_time.php">Настройка актуального времени на серверах</a><br/></li>
	<li><a href="oracle_rac_dnsserv.php">Настройка DNS сервера</a><br/></li>
	<li><a href="oracle_rac_networking.php">Настройка конфигурации сетевых интерфейсов</a><br/></li>
	<li><a href="oracle_rac_user_config.php">Создание пользователя oracle11 и групп</a><br/></li>
	<li><a href="oracle_rac_secure_shell.php">Настройка Secure Shell между узлами кластера</a><br/></li>
	<li><a href="oracle_rac_packages.php">Инсталляция необходимых пакетов</a><br/></li>
	<li><a href="oracle_rac_packages_autostart.php">Выбор пакетов для автозапуска</a><br/></li>
	<li><a href="oracle_rac_disks.php">Подготовка дисков</a><br/></li>
	<li><a href="oracle_rac_isci_disks.php">Инсталляция ISCSI и монтирование iscsi дисков</a><br/></li>
	<li><a href="oracle_rac_asm_disks.php">Инсталляция и конфигурирование ASM</a><br/></li>
	<li><a href="oracle_rac_kernel.php">Изменение параметров ядра и параметров учетной записи администратора базы данных</a><br/></li>
	<li><a href="oracle_rac_catalogs.php">Создание структуры каталогов и назначение необходимых прав</a><br/></li>
	<li><a href="oracle_rac_check_before_install.php">Проверка конфигурации кластера перед инсталляцией RAC</a><br/></li>
	<li><a href="oracle_rac_copy_distr.php">Копирование дистрибутивов базы данных на сервер</a><br/></li>
</ul>

<br/><br/>

<h2>Инсталляция RAC и создание экземпляров баз данных:</h2>	

	
<ul>	
	<li><a href="oracle_rac_grid_installation.php">Инсталляция Grid</a><br/></li>
	<li><a href="oracle_rac_database_software_installation.php">Инсталляция Oracle Database Software</a><br/></li>
	<li><a href="oracle_rac_instance_installation.php">Создание экземпляра (instance) базы данных</a><br/></li>
</ul>	


<br/><br/>

<h2>Шаги, выполняемые после развертывания:</h2>	

	
<ul>	
	
	<li><a href="oracle_rac_post_installation.php">После инсталляции</a><br/></li>
	<li><a href="oracle_rac_patching.php">Применение патчей (11.2.0.3.2)</a><br/></li>
</ul>


<br/><br/>
<h2>Дополнительно:</h2>


<ul>
<li><a href="oracle_rac_tests.php">Некоторые запросы и команды</a><br/></li>
	<li><a href="oracle_rac_processes_info.php">Процессы Oracle RAC</a><br/></li>

</ul>





<br/><br/>
<br/><br/>


        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'oracle-dba'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        


<br/><br/>
<br/><br/>





</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
