<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
	<div align="left">


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>"><img src="remote_oracle_dba.jpeg" border="0" alt="Remote Oracle DataBase Administrator"></a><br/></div>




<br/>
<br/><br/>

<div align="center">
<h3>Подготовка окружения (виртуальной машины VirtualBox) для инсталляции базы данных Oracle 11G R2</h3><br/>



<br/><br/>
<div align="left">

Пример создания виртуальной машины VirtualBox для инсталляции сервера баз данных Oracle 11G R2<br/>
Виртуальная машина создается в ubuntu. Аналогичным образом виртуальная машина создается в redhat.


<pre>

$ id
uid=1001(vmadm) gid=1010(vmadmins) groups=1010(vmadmins)



<strong>Добавляю в конец файла .bashrc ссылку на файл .bash_profile, в котором будут храниться переменные окружения пользователя:</strong>

<pre>

$ vi ~/.bashrc

############################################################
# Source bash_profile to set JAVA_HOME and add it to the PATH
. ~/.bash_profile 
############################################################


</pre>


---------------------------------------


Настройки переменных окружения


$  vim ~/.bash_profile

Добавьте

############################################

#### VirtualBox Environment:

       
          export vm_home=$HOME/machines
          export vm_backups=${vm_home}/backups


############################################

В качестве VM_HOME - лучше указать раздел не $HOME - а какой-нибудь раздел, где достаточно места для хранения файлов данных для виртуальных машин. В моем случае это другой диск.


Применить новые параметры:

# source ~/.bash_profile        


<h3>Создание виртуальной машины VirtualBox</h3>


Задаем переменную с именем создаваемой виртуальной машины, чтобы в дальнейшем лишний раз не подставлять данное значение в команды.


# su - vmadm
$ vm=vm_oel63_oradb112
$ echo $vm
vm_oel63_oradb112

Создаем каталоги для виртуальной машины  и для snapshots
$ mkdir -p ${vm_home}/${vm}/snapshots


Создание и регистрация виртуальной машины:

Узнать список поддерживаемых операционных систем
$ VBoxManage list ostypes

$ VBoxManage createvm \
--name ${vm} \
--ostype Oracle_64 \
--basefolder ${vm_home}/${vm} \
--register

Должно появиться сообщение:
Virtual machine 'vm_oel63_oradb112' is created and registered.


Выбираю материнскую пату с более современным чипсетом . По умолчанию piix3
$ VBoxManage modifyvm ${vm}  --chipset piix3


Устанавливаю процессоры.
$ VBoxManage modifyvm ${vm}  --cpus 2


Устанавливаем планку оперативной памяти
$ VBoxManage modifyvm ${vm} --memory 2048

Подключаем видеокарту на 32 MB
$ VBoxManage modifyvm ${vm} --vram 32

Снимаем sound карту, вытаскиваем дисковвод
$ VBoxManage modifyvm ${vm} --floppy disabled --audio none

Подключаю контроллер жестких дисков (SAS)
$ VBoxManage storagectl ${vm} \
--add sas \
--name "SAS Controller"



Создаю виртуальные жесткие диски. Размер (size), рекомендуется задавать согласно имеющихся ресурсов. Иначе возможны проблемы и крах виртуальной машины):

$ cd ${vm_home}/${vm}/${vm}

$ VBoxManage createhd \
--filename ${vm}_dsk1.vdi \
--size 40960 \
--format VDI \
--variant Standard

$ VBoxManage createhd \
--filename ${vm}_dsk2.vdi \
--size 40960 \
--format VDI \
--variant Standard

$ VBoxManage createhd \
--filename ${vm}_dsk3.vdi \
--size 40960 \
--format VDI \
--variant Standard


$ VBoxManage createhd \
--filename ${vm}_dsk4.vdi \
--size 40960 \
--format VDI \
--variant Standard

$ VBoxManage createhd \
--filename ${vm}_dsk5.vdi \
--size 40960 \
--format VDI \
--variant Standard

$ VBoxManage createhd \
--filename ${vm}_dsk6.vdi \
--size 40960 \
--format VDI \
--variant Standard

$ VBoxManage createhd \
--filename ${vm}_dsk7.vdi \
--size 40960 \
--format VDI \
--variant Standard


$ VBoxManage createhd \
--filename ${vm}_dsk8.vdi \
--size 40960 \
--format VDI \
--variant Standard




Подключаю диски к SAS контроллеру (максимум 8)

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 0 \
--type hdd \
--medium ${vm}_dsk1.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 1 \
--type hdd \
--medium ${vm}_dsk2.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 2 \
--type hdd \
--medium ${vm}_dsk3.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 3 \
--type hdd \
--medium ${vm}_dsk4.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 4 \
--type hdd \
--medium ${vm}_dsk5.vdi


$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 5 \
--type hdd \
--medium ${vm}_dsk6.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 6 \
--type hdd \
--medium ${vm}_dsk7.vdi

$ VBoxManage storageattach ${vm} \
--storagectl "SAS Controller" \
--port 7 \
--type hdd \
--medium ${vm}_dsk8.vdi


Подключаем IDE контроллер к которому будет позднее подключен DVD-ROM
$ VBoxManage storagectl ${vm} \
--add ide \
--name "IDE Controller"


Подключаю к IDE контроллеру DVD образ инсталлируемой операционной системы:

$ VBoxManage storageattach ${vm} \
--storagectl "IDE Controller" \
--port 0 \
--device 0 \
--type dvddrive \
--medium /mnt/dsk2/_ISO/_OEL/Oracle_Linux_Release_6_Update_3_for_x86_64.iso



$ VBoxManage storageattach ${vm} \
--storagectl "IDE Controller" \
--port 0 \
--device 0 \
--type dvddrive \
--medium /mnt/dsk2/_ISO/_OEL/Oracle_Linux_Release_6_Update_3_for_x86_64.iso



Подключение сетевых интерфейсов:

Наберите команду;
$ VBoxManage list bridgedifs

Обратите внимание на значение:
Name:            eth0

Я использую eth0 как основной физический интерфейс, который будут использовать виртуальные машины в качестве моста.


Подключаю к виртуальной машине 2 виртуальных сетевых интерфеса “Intel® 82540EM Gigabit Ethernet Controller”, работающих как bridget:


$ VBoxManage modifyvm ${vm} \
--nictype1 82540EM \
--nic1 bridged \
--bridgeadapter1 eth0


$ VBoxManage modifyvm ${vm} \
--nictype2 82540EM \
--nic2 bridged \
--bridgeadapter2 eth0


 (Если планируется инсталлировать RAC, рекомендуется установить 3-й интерфейс)

$ VBoxManage modifyvm ${vm} \
--nictype3 82540EM \
--nic3 bridged \
--bridgeadapter3 eth0


// Определяем порядок устройств, с которых будет произведена попытка стартовать систему
$ VBoxManage modifyvm ${vm} \
--boot1 disk \
--boot2 dvd


Определяем каталог для снапшотов
$ VBoxManage modifyvm ${vm} \
--snapshotfolder ${vm_home}/${vm}/snapshots


Предоставим возможность подключения к машине по RDP:

$ VBoxManage modifyvm ${vm} \
--vrde on \
--vrdemulticon on \
--vrdeauthtype null \
--vrdeaddress 192.168.1.5 \
--vrdeport 3389

Здесь мы указываем:

--vrdeaddress - ip адрес машины, на которой установлен vitrualbox
--vrdeauthtype null - аутентификация не требуется.
--vrdemulticon on - разрешено множественное подключение к виртуальным машинам.
--vrdeport порт к которому можно будет подключиться при старте виртуальной машины.




ВИРТУАЛЬНАЯ МАШИНА ГОТОВА ДЛЯ ИНСТАЛЛЯЦИИ ОПЕРАЦИОННОЙ СИСТЕМЫ


Показать результат созданной виртаульной машины:
$ VBoxManage showvminfo ${vm}  | less


Стартуем виртуальную машину с возможность подключения по RDP
$ VBoxHeadless --startvm ${vm} &


Посмотреть стартованные виртуальные машины можно командой
$ vboxmanage list runningvms

Если работаете в linux, подключиться к виртуальной машине можно с помощью rdesktop

$ rdesktop \
-r sound:local \
-k common  \
-g  1600x1024 \
192.168.1.5:3389


// Если нужно подключиться с определенной “геометрией”
-g  1600x1024

// Если нужно работать в полноэкранном режиме, нужно убрать ключ -g и заменить его ключом -f 
Для выхода из полноэкранного режима - CTRL+ALT+ENTER


rdesktop - всевозможные ключи:
http://manpages.ubuntu.com/manpages/lucid/man1/rdesktop.1.html




В Windows для этого вполне подойдет Remote Desktop Connecton (mstsc.exe)

<br/><br/>
Более подробный документ с созданием снапшотов и резервных коиий виртуальных машин:<br/>
https://docs.google.com/document/d/1ZU6Hk5DYitFYwlRFqN2qmJr6maPpvgsVc6ZTiZ1kYVA/edit

</pre>

</div>
</div>
<br/><br/><br/>




</div>	
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
