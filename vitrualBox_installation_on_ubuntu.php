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
<h3>Инсталляция VirtualBox в операционной системе Ubuntu в консоли</h3><br/>

</div>



<pre>

VirtubalBox устанавливается на Ubuntu 12.


Дистрибутивы Ubuntu:
http://ubuntu.com

Дистрибутивы VirtualBox:
http://virtualbox.org



// Получить роли суперпользователя
$ sudo su -


// Обновить заголовки репоизитория
# apt-get -y update


// Инсталляция пакетов
$ sudo apt-get install -y \
vim \
wget


// Создаем группу администраторов виртуальных машин:
# groupadd -g 1010 vmadmins


// Создаем пользователя для работы с виртуальными машинами
# useradd \
-g vmadmins \
-d /home/vmadm \
-s /bin/bash \
-m vmadm


// Назначить пароль созданному пользователю
# passwd vmadm


// Добавляю пользователя vmadm в группу привелигированных пользователей

// Резервная копия файла
# cp /etc/sudoers /etc/sudoers.bkp

// Предоставление пользователю vmadm возможности подключиться с правами root
# echo 'vmadm ALL=(ALL) ALL' >> /etc/sudoers

# su - vmadm

$ cd /tmp/


// Дистрибутив virtualbox
$ wget http://download.virtualbox.org/virtualbox/4.2.0/virtualbox-4.2_4.2.0-80737~Ubuntu~oneiric_amd64.deb

// Дополнения для virtualbox (не Open Source )
$ wget http://download.virtualbox.org/virtualbox/4.2.0/Oracle_VM_VirtualBox_Extension_Pack-4.2.0-80737.vbox-extpack


$ chmod +x virtualbox-4.2_4.2.0-80737~Ubuntu~oneiric_amd64.deb 



$ sudo dpkg -i virtualbox-4.2_4.2.0-80737~Ubuntu~oneiric_amd64.deb 


output:

[sudo] password for vmadm: 
Selecting previously unselected package virtualbox-4.2.
(Reading database ... 148563 files and directories currently installed.)
Unpacking virtualbox-4.2 (from virtualbox-4.2_4.2.0-80737~Ubuntu~oneiric_amd64.deb) ...
Setting up virtualbox-4.2 (4.2.0-80737~Ubuntu~oneiric) ...
Adding group `vboxusers' (GID 125) ...
Done.
 * Stopping VirtualBox kernel modules                                    [ OK ] 
 * Uninstalling old VirtualBox DKMS kernel modules                       [ OK ] 
 * Trying to register the VirtualBox kernel modules using DKMS           [ OK ] 
 * Starting VirtualBox kernel modules                                    [ OK ] 
Processing triggers for ureadahead ...
ureadahead will be reprofiled on next reboot
Processing triggers for shared-mime-info ...
Processing triggers for desktop-file-utils ...
Processing triggers for bamfdaemon ...
Rebuilding /usr/share/applications/bamf.index...
Processing triggers for gnome-menus ...
Processing triggers for hicolor-icon-theme ...



$ sudo VBoxManage extpack install Oracle_VM_VirtualBox_Extension_Pack-4.2.0-80737.vbox-extpack

output:

0%...10%...20%...30%...40%...50%...60%...70%...80%...90%...100%
Successfully installed "Oracle VM VirtualBox Extension Pack".


$ vboxmanage -v
4.2.0r80737


// Забираю права суперпользователя 
$ sudo cp /etc/sudoers.bkp /etc/sudoers

</pre>


</div>
<br/><br/><br/>




</div>	
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
