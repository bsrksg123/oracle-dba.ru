<html>

<?php include_once "_header.php"?>
<?php include_once '/home/marley/oracle-dba.ru/_syntax/geshi/geshi.php' ?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Настройка сети (Настройка слушивающего процесса Listener)</h2><br/>

2 конфигурационных файла отвечают за подключение к Oracle.<br/>
Один обязательный (listener.ora) и один скорее для удобства, но для работы некоторых программ, он также может быть обязательным
(tnsnames.ora).<br/>
<br/><br/>

По умолчанию файлы хранятся:

<br/>
/u01/app/oracle/product/11.2/network/admin

<br/><br/>
<strong>listener.ora</strong>
<br/>




<?php

$source = 'LISTENER =
  (DESCRIPTION_LIST =
    (DESCRIPTION =
      (ADDRESS_LIST =
        (ADDRESS = (PROTOCOL = TCP)(HOST = hostname.domain.com)(PORT = <port_number>))
      )
    )
  )

SID_LIST_LISTENER =
  (SID_LIST =
  (SID_DESC =
      (GLOBAL_DBNAME = SID1)
      (ORACLE_HOME = /u01/app/oracle/product/11.2)
      (SID_NAME = SID1)
    )
  (SID_DESC =
      (GLOBAL_DBNAME = SID2)
      (ORACLE_HOME = /u01/app/oracle/product/11.2)
      (SID_NAME = SID2)
    )

  )';$language = 'java';


// Create a GeSHi object//
$geshi = new GeSHi($source, $language);

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS); 

$geshi->set_line_style('color: black; background: #fcfcfc;', 'color: green; background: #f0f0f0;');

// Disabling all URLs for Keywords
$geshi->enable_keyword_links(false);

// And echo the result!//
echo $geshi->parse_code();

?>





  
  
  <br/>
  <strong>tnsnames.ora</strong><br/>
  <br/>
  В данном файле описываются подробности подключения к базе данных. Т.о, становится возможным явно не указывать некоторые параметры. (Например, хост, порт и др.).
  И сразу обращаться по имени.
  
  

  <br/><br/>
  
 <?php

$source = 'SID1 =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = hostname.domain.com)(PORT = <port_number>))
    )
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = SID1)
    )
  )

SID2 =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = hostname.domain.com)(PORT = <port_number>))
    )
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = SID2)
    )
  )
';$language = 'java';


// Create a GeSHi object//
$geshi = new GeSHi($source, $language);

$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS); 

$geshi->set_line_style('color: black; background: #fcfcfc;', 'color: green; background: #f0f0f0;');

// Disabling all URLs for Keywords
$geshi->enable_keyword_links(false);

// And echo the result!//
echo $geshi->parse_code();

?>
  
  
   <br/><br/>
  
  В следующем примере, происходит подключение к базе данных с использованием записи с именем orcl в файле tnsnames.ora.<br/>
  Т.е. для подключения к базе, не приходится дополнительно вводить host, port, sid
  <br/><br/>
  <img src="http://img.fotografii.org/images/odba/oracleInstallation/_Windows/Oracle_Database_10g_Release_2_Installation/Oracle_Database_10g_Release_2_Installation_114.png" border="0" alt="tnsnames.ora">
  
  
  
  

<br/><br/>
<br/><br/>

<strong>Основные команды службы слушателя (Listener):</strong>
<br/><br/>
lsnrctl status<br/>
lsnrctl stop<br/>
lsnrctl start<br/>
lsnrctl restart<br/>

</div>	



<?php include_once "_footer.php"?>

</body>

</html>


