<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Подготовка дисков к инсталляции базы данных</h2>

<br/><br/>

<pre> 

В каталоге /u01 будет храниться программное обеспечение для работы с базами данных (Database Software) а в каталоге /u02 файлы базы данных.


# ls /dev/sd*
/dev/sda   /dev/sda2  /dev/sdc  /dev/sde  /dev/sdg
/dev/sda1  /dev/sdb   /dev/sdd  /dev/sdf  /dev/sdh


# fdisk /dev/sdb
# fdisk /dev/sdc
# fdisk /dev/sdd

The number of cylinders for this disk is set to 5221.
There is nothing wrong with that, but this is larger than 1024,
and could in certain setups cause problems with:
1) software that runs at boot time (e.g., old versions of LILO)
2) booting and partitioning software from other OSs
 (e.g., DOS FDISK, OS/2 FDISK)

Command (m for help): n
Command action
 e   extended
 p   primary partition (1-4)
[p]
Partition number (1-4): [1]
First cylinder (1-5221, default 1): [Enter]
Using default value 1
Last cylinder or +size or +sizeM or +sizeK (1-5221, default 5221): [Enter]
Using default value 5221

Command (m for help): [w]
The partition table has been altered!

Calling ioctl() to re-read partition table.
Syncing disks.



# mkfs.ext4 /dev/sdb1
# mkfs.ext4 /dev/sdc1
# mkfs.ext4 /dev/sdd1

# mkdir /u01
# mkdir /u02
# mkdir /u03


# cp /etc/fstab /etc/fstab.bkp
# echo "/dev/sdb1 /u01 ext4 defaults 1 2" >> /etc/fstab
# echo "/dev/sdc1 /u02 ext4 defaults 1 2" >> /etc/fstab
# echo "/dev/sdd1 /u03 ext4 defaults 1 2" >> /etc/fstab

# mount /u01
# mount /u02
# mount /u03

# mount | grep sdb1
/dev/sdb1 on /u01 type ext4 (rw)

# mount | grep sdc1
/dev/sdc1 on /u02 type ext4 (rw)

# mount | grep sdd1
/dev/sdd1 on /u03 type ext4 (rw)

</pre> 

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
