<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Подготовка дисков</h2>

<table cellpadding="4" cellspacing="2" align="center" border="0" width="98%">  
<tbody> 
   
<tr>      
<td style="color: rgb(255, 255, 255);" bgcolor="#386351" width="14%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>Server:</strong></span></td>      
<td height="20" bgcolor="#a2bcb1" width="60%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>node1, node2</strong></span></td>      
<td rowspan="3" align="center" valign="middle" width="26%"></td>
</tr>

</table>



<pre>
# fdisk /dev/sdb


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
p
Partition number (1-4): 1
First cylinder (1-5221, default 1):
Using default value 1
Last cylinder or +size or +sizeM or +sizeK (1-5221, default 5221):
Using default value 5221

Command (m for help): w
The partition table has been altered!

Calling ioctl() to re-read partition table.
Syncing disks.



# mkfs.ext4 /dev/sdb1

# mkdir /u01

# cp /etc/fstab /etc/fstab.bkp
# echo "/dev/sdb1 /u01 ext4 defaults 1 2" >> /etc/fstab

# mount /u01

# mount | grep sdb1
/dev/sdb1 on /u01 type ext4 (rw)

</pre>


</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
