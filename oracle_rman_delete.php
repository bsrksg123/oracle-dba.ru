<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Удаление объектов RMAN (Recovery Manager)</h2><br/>


<br/><br/>

<pre>

// Удалить устаревшие бэкапы с подтверждением удаления
RMAN> delete obsolete;

// Удалить устаревшие бэкапы без подтверждения удаления
RMAN> delete noprompt obsolete;

RMAN> DELETE EXPIRED BACKUP;
RMAN> DELETE EXPIRED COPY;

// Удалить copy
RMAN> delete copy;

// Удалить backupset с определенным ID
RMAN> delete backupset 20; 


// Удалить архивные журналы.
RMAN> delete archivelog all;

</pre>

</div>	



<?php include_once "_footer.php"?>

</body>

</html>


