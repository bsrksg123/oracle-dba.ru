﻿<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Инсталляция обязательных пакетов</h2>

<br/><br/>
<pre> 

База данных Oracle, требует, чтобы в системе были обязательно установлены некоторые компоненты. Пакеты можно скачать с публичного репозитория (из интернет) или взять с диска, на котором и располагается дистрибутив операционной системы.

1) Инсталляция пакетов с DVD диска Oracle Linux:

# mkdir /mnt/cdrom
# mount -t iso9660 -o ro /dev/cdrom /mnt/cdrom

# vi /etc/yum.repos.d/oracleLinuxRepoDVD.repo

[OEL63_DVD]
name=Oracle Enterprise Linux DVD
baseurl=file:///mnt/cdrom/Server/
gpgcheck=0
enabled=1



2) Инсталляция пакетов из репозитория Oracle Linux в интернете:

# vi /etc/yum.repos.d/oracleLinuxRepoINTERNET.repo
[OEL_INTERNET]
name=Oracle Enterprise Linux $releasever - $basearch
baseurl=http://public-yum.oracle.com/repo/OracleLinux/OL6/latest/$basearch/
gpgkey=http://public-yum.oracle.com/RPM-GPG-KEY-oracle-ol6
gpgcheck=1
enabled=1


# yum repolist
# yum update -y


======================================

Offtopic: (Рекомендуется пропустить! Просто для информации)

Вы можете выполнить следующую команду и пропустить большую часть шагов по установке необходимых пакетов и правильной настройке окружения для инсталляции Oracle.

# yum install -y oracle-validated

Выполнив данную команду, Oracle сам инсталлирует все необходимые пакеты, создаст необходимых пользователей, внесет изменения в конфигурационные файлы.
Имеется только один минус, возможно, что он сделает не все так как вы хотите. Т.е. будет выполнена подготовка окружения “по умолчанию”.

======================================

Следующие пакеты должны быть установлены: 

binutils-2.20.51.0.2-5.11.el6 (x86_64)
compat-libcap1-1.10-1 (x86_64)
compat-libstdc++-33-3.2.3-69.el6 (x86_64)
compat-libstdc++-33-3.2.3-69.el6.i686
gcc-4.4.4-13.el6 (x86_64)
gcc-c++-4.4.4-13.el6 (x86_64)
glibc-2.12-1.7.el6 (i686)
glibc-2.12-1.7.el6 (x86_64)
glibc-devel-2.12-1.7.el6 (x86_64)
glibc-devel-2.12-1.7.el6.i686
ksh
libgcc-4.4.4-13.el6 (i686)
libgcc-4.4.4-13.el6 (x86_64)
libstdc++-4.4.4-13.el6 (x86_64)
libstdc++-4.4.4-13.el6.i686
libstdc++-devel-4.4.4-13.el6 (x86_64)
libstdc++-devel-4.4.4-13.el6.i686
libaio-0.3.107-10.el6 (x86_64)
libaio-0.3.107-10.el6.i686
libaio-devel-0.3.107-10.el6 (x86_64)
libaio-devel-0.3.107-10.el6.i686
make-3.81-19.el6
sysstat-9.0.4-11.el6 (x86_64)


# yum install -y \
binutils.x86_64 \
compat-libcap1.x86_64 \
compat-libstdc++-33.i686 \
compat-libstdc++-33.x86_64 \
gcc.x86_64 \
gcc-c++.x86_64 \
glibc.i686 \
glibc.x86_64 \
glibc-devel.i686 \
glibc-devel.x86_64 \
ksh.x86_64 \
libgcc.i686 \
libgcc.x86_64 \
libstdc++.i686 \
libstdc++.x86_64 \
libstdc++-devel.i686 \
libstdc++-devel.x86_64 \
libaio.i686 \
libaio.x86_64 \
libaio-devel.i686 \
libaio-devel.x86_64 \
make.x86_64 \
sysstat.x86_64




Следующий пакет нужен для старта графической консоли
# yum install -y xdpyinfo


Дополнительные пакеты:

# yum install -y \
mc \
nano \
vim \
emacs \
wget \
xinetd \
screen \
ntp \
unzip



rlwrap - пакет, который позволяет хранить историю команд в SQL*PLUS и RMAN в Linux (его необходимо прописывать отдельной строкой в bash профиле). Установив данный пакет, вы сможете использовать кнопки вверх, вниз для просмотра истории введенных команд, правильную работу команды backspace и др.

# yum install -y \
readline-devel.x86_64

# cd /tmp
# wget http://utopia.knoware.nl/~hlub/uck/rlwrap/rlwrap-0.37.tar.gz




# tar zxvf rlwrap-0.37.tar.gz
# cd rlwrap-0.37
# ./configure
# make
# make check
# make install

</pre> 

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
