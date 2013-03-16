<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Настройка Secure Shell между узлами кластера</h2>

<pre>


Необходимо, чтобы узлы кластера могли обмениваться между собой по протоколу ssh.
Когда устанавливается Oracle RAC, он устанавливается только на первую ноду, 
на все стальные он просто копируется.


Настраиваем secure shell (ssh) 

node1

# su - oracle11

$ mkdir ~/.ssh
$ chmod 700 ~/.ssh



Создаем RSA-type public и private encryption keys. (На все вопросы просто жмем Enter)

$ /usr/bin/ssh-keygen -t rsa

Создаем DSA-type public и private encryption keys.  (На все вопросы жмем Enter)

$ /usr/bin/ssh-keygen -t dsa


$ cd .ssh/


Добавляем полученные ключи в файл authorized key.

$ cat id_rsa.pub >>authorized_keys
$ cat id_dsa.pub >>authorized_keys 

$ ssh node2 mkdir /home/oracle11/.ssh/

$ scp authorized_keys node2:/home/oracle11/.ssh

$ ssh node2

Повторяем процедуру генерации

$ /usr/bin/ssh-keygen -t rsa
$ /usr/bin/ssh-keygen -t dsa


$ cd ~/.ssh
$ cat id_rsa.pub >> authorized_keys
$ cat id_dsa.pub >> authorized_keys


$ chmod 644 authorized_keys

$ scp authorized_keys node1:/home/oracle11/.ssh

$ ssh node1

$ exec /usr/bin/ssh-agent $SHELL
$ /usr/bin/ssh-add


Проверяем, что все работает нормально. Необходимо постараться пройти все возможные варианты подключений между узлами без ввода учетных записей.

$ ssh node1 date
$ ssh node2 date

$ ssh node1.localdomain date
$ ssh node2.localdomain date

$ ssh node2

$ ssh node1 date
$ ssh node2 date

$ ssh node1.localdomain date
$ ssh node2.localdomain date

</pre>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
