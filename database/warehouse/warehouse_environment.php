<html>

<?php include_once "../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Oracle Database Data Warehousing]: Подготовка окружения</h2>
<br/><br/>

<br/><br/>


<strong>В книге решили реализовать следующие табличные пространства.</strong>

	<ul>
		<li>Dimensions (Измерения)  — для всех данных измерений.</li>
		<li>Purchases_month_year (Год и месяц покупки) — для таблицы фактов, в которой
		применяется секционирование.</li>		
		<li>Index tablespaces (Индексное табличное пространство)  — для индексов.</li>
		<li>Summary (Суммарные данные) — для создаваемых нами материализованных
		представлений.</li>
		<li>Default area (Область по умолчанию), которая выделяется пользователю по
		умолчанию.</li>
		<li>Temp area (Временная область)  — в качестве временного места хранения.</li>
	</ul>



<br/><br/>


Создавать хранилище под виндовс - дело рискованное!
<br/>
Будем делать под Oracle Linux<br/>

<br/><br/>
<li><a href="http://oracle-dba.ru/installation.php">Инсталляция базы данных Oracle</a><br/></li>



	
<br/><br/>

<h2>Создание табличных пространств и файлов данных</h2>	


<br/><br/>
PCTINCREASE - (Percent Increase) - определяет размер экстентов после второго (т.е. начиная с третьего экстента). Размер первоначального экстента равен INITIAL. Размер второго экстента равен NEXT. Если PCTINCREASE не равен нулю, то все последующие экстенты будут определяться как предыдущий размер экстента, увеличенный на процент PCTINCREASE. Если PCTINCREASE равен нулю, то все последующие экстенты по размеру будут равны числу NEXT. По умолчанию PCTINCREASE = 50 (для сегментов отката по умолчанию он равен нулю).

<br/><br/>
Если выполнить команды по книге, для базы данных 11g, (По умолчанию, размер блока в Oracle 11g равен 8 Кб.) Получим сообщение:<br/>
ORA-03249: Uniform size for auto segment space managed tablespace should have atleast 5 blocks


<br/><br/>

Первый шаг — подключиться к базе данных с правами администратора.

<br/><br/>

connect system/manager

<br/><br/>
Следующий шаг — создание табличных пространств и файлов данных для их хранения.

<br/><br/>



<br/><br/>
Несколько модифицированные команды для создания табличных пространств:
<br/><br/>

<pre>

-- Tablespace for Dimensions
CREATE TABLESPACE easy_dimensions
DATAFILE '/u02/oradata/EASYDW/easy_dimensions_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


-- Tablespace for the INDEXES
CREATE TABLESPACE easy_idx
DATAFILE '/u02/oradata/EASYDW/easy_idx_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


-- Tablespace to store Materialized Views
CREATE TABLESPACE easy_mview
DATAFILE '/u02/oradata/EASYDW/easy_mview_01.dbf' SIZE 6m 
REUSE AUTOEXTEND ON 
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


-- Default Tablespace
CREATE TABLESPACE easy_default
DATAFILE '/u02/oradata/EASYDW/easy_default_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


-- Temporary Tablespace
CREATE TEMPORARY TABLESPACE easy_temp
TEMPFILE '/u02/oradata/EASYDW/easy_temp_01.dbf' SIZE 10m 
REUSE AUTOEXTEND ON NEXT 16k;


-- UNDO Tablespace
CREATE TABLESPACE easy_undo
DATAFILE '/u02/oradata/EASYDW/easy_undo_01.dbf' SIZE 8m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


</pre>

<br/><br/>

Как только созданы табличные пространства для измерений, мы можем создавать табличные пространства для таблицы фактов (purchases, покупки). Поскольку мы будем делать секционирование данных, мы должны создать табличное пространство для каждого раздела. Будут помесячные разделы для данных и еще один раздел для индексов. Здесь мы создадим разделы только для данных января месяца и индекса. Для создания других разделов просто повторяйте эти операции.


<br/><br/>

<pre>

---- Январь 2002

-- create the 3 month tablespaces for the fact partitions
CREATE TABLESPACE easy_purchases_jan_2002
DATAFILE '/u02/oradata/ora112/easy_purchases_jan_2002_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);

-- create the 3 month tablespaces for the fact indexes
CREATE TABLESPACE easy_purchases_jan_2002_idx
datafile '/u02/oradata/ora112/easy_purchases_jan_2002_idx_01.dbf' SIZE 3m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


---- Февраль 2002


-- create the 3 month tablespaces for the fact partitions
CREATE TABLESPACE easy_purchases_feb_2002
DATAFILE '/u02/oradata/ora112/easy_purchases_feb_2002_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);

-- create the 3 month tablespaces for the fact indexes
CREATE TABLESPACE easy_purchases_feb_2002_idx
datafile '/u02/oradata/ora112/easy_purchases_feb_2002_idx_01.dbf' SIZE 3m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


----- Март 2002

-- create the 3 month tablespaces for the fact partitions
CREATE TABLESPACE easy_purchases_mar_2002
DATAFILE '/u02/oradata/ora112/easy_purchases_mar_2002_01.dbf' SIZE 5m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);

-- create the 3 month tablespaces for the fact indexes
CREATE TABLESPACE easy_purchases_mar_2002_idx
datafile '/u02/oradata/ora112/easy_purchases_mar_2002_idx_01.dbf' SIZE 3m 
REUSE AUTOEXTEND ON
DEFAULT STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0 MAXEXTENTS UNLIMITED);


</pre>

<br/><br/>
<h2>Создание таблиц, ограничений и индексов</h2>
<br/><br/>

Когда табличные пространства определены, можно создавать пользователя
EASYDW, что образует схему, в которой будут сохраняться данные.

<br/><br/>

<pre>

-- create a user called EASYDW
-- this will be the schema where the objects will reside
connect system/manager

CREATE USER easydw IDENTIFIED BY easydw
DEFAULT TABLESPACE easydw_default
TEMPORARY TABLESPACE easy_temp
PROFILE DEFAULT ACCOUNT UNLOCK;

GRANT unlimited tablespace TO easydw ;
GRANT dba TO easydw ;
GRANT create session TO easydw;


quit

</pre>

<br/><br/>

Пользователям предоставляют привилегии администратора базы, чтобы они могли создавать таблицы и схемы и управлять ими.


<br/><br/>


<pre>

-- now create the tables
CONNECT easydw/easydw


-- CUSTOMER Dimension
CREATE TABLE easydw.customer
(customer_id     varchar2(10),
town             varchar2(10),
county           varchar2(10),
dob              date,
country          varchar2(20),
occupation       varchar2(10))
PCTFREE 0 PCTUSED 99
TABLESPACE easy_dimensions
STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0);



CREATE UNIQUE INDEX easydw.customer_pk_index ON customer (customer_id)
pctfree 5
tablespace easy_idx
storage (initial 40k next 40k pctincrease 0);



ALTER TABLE customer
ADD CONSTRAINT pk_customer PRIMARY KEY (customer_id);

</pre>

<br/><br/>

Здесь мы определили ограничение, добавив его внизу. Его также можно создать внутри определения CREATE TABLE, но, если использовать такой подход, вы
не сможете контролировать имя индекса (с целью быстрой проверки первичного ключа), которое в этом случае создается по умолчанию. Следовательно, мы сна-
чала создаем индекс, а когда определено ограничение, оно использует этот индекс, а не создает свой собственный.

<br/><br/>


<pre>

-- PRODUCT Dimension
CREATE TABLE easydw.product
(product_id      varchar2(8),
product_name     varchar2(30),
category         varchar2(4),
cost_price       number (6,2)
constraint       cost_price_not_null NOT NULL,
sell_price       number (6,2)
constraint       sell_price_not_null NOT NULL,
weight           number (6,2),
shipping_charge  number (5,2)
constraint       shipping_charge_not_null NOT NULL,
manufacturer     varchar2(20),
supplier         varchar2(10))
PCTFREE 0 PCTUSED 99
TABLESPACE easy_dimensions
STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0);


CREATE UNIQUE INDEX easydw.product_pk_index ON product (product_id)
pctfree 5
tablespace easy_idx
storage (initial 40k next 40k pctincrease 0);



ALTER TABLE product
ADD CONSTRAINT pk_product PRIMARY KEY (product_id);


</pre>

<br/><br/>

Затем создается таблица TIME. В эту таблицу мы включили проверочное
(CHECK) ограничение, обеспечивающее наличие в столбце «public_holiday»
только значений «Y» или «N».



<br/><br/>
<pre>


-- TIME Dimension
CREATE TABLE easydw.time
(
time_key           date,  
day                number (2,0),
month              number (2,0),
quarter            number (2,0),
year               number (4,0),
day_number         number (3,0),
day_of_the_week    varchar2(8),
week_number        number (2,0),
public_holiday     varchar2(1) 
  constraint public_holiday
  CHECK (public_holiday IN ('Y', 'N'))  )
PCTFREE 0 PCTUSED 99
TABLESPACE easy_dimensions
STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0);


CREATE UNIQUE INDEX easydw.time_pk_index ON time (time_key)
pctfree 5
tablespace easy_idx
storage (initial 40k next 40k pctincrease 0);


ALTER TABLE time
ADD CONSTRAINT pk_time PRIMARY KEY (time_key);

</pre>

<br/><br/>

Для таблицы TODAYS_SPECIAL_OFFER мы определили первичный ключ, включив два столбца, а не один.

<br/><br/>

<pre>

-- TODAYS_SPECIAL_OFFERS Dimension
CREATE TABLE easydw.todays_special_offers
(product_id       varchar2(8),
offer_date        date,
special_price     number (6,2),
offer_price       number (6,2))
PCTFREE 0 PCTUSED 99
TABLESPACE easy_dimensions
STORAGE (INITIAL 40k NEXT 40k PCTINCREASE 0);





CREATE UNIQUE INDEX easydw.tso_pk_index ON todays_special_offers
(offer_date, product_id)
pctfree 5 tablespace easy_idx
storage (initial 40k next 40k pctincrease 0);


ALTER TABLE todays_special_offers
ADD CONSTRAINT pk_specials PRIMARY KEY
(offer_date,product_id );

</pre>

<br/><br/>

Теперь мы переходим к созданию наиболее важной таблицы — таблицы фактов, которую мы назвали PURCHASES (Покупки). Определение этой таблицы весьма сложно, поскольку в нее входят несколько внешних ключей (FOREIGN KEYS) к нескольким таблицам, идентифицируемым по условию REFERENCES (ссылки). В таблице определяются два ограничения для столбца product_id: ограничение NOT NULL и ограничение foreign-key. Если каждому из ограничений дать уникальное имя, тогда их можно применить к столбцу таблицы. Здесь мы приводим пример того, как секционировать таблицу. 

<br/><br/>

<pre>
-- 

-- ERROR at line 1:
-- ORA-00439: feature not enabled: Partitioning
-- нужно доустанавливать опцию 


-- Fact Table PURCHASES
CREATE TABLE easydw.purchases
(product_id            varchar2(8)
    CONSTRAINT         not_null_product_id NOT NULL
    CONSTRAINT         fk_product_id  
    REFERENCES         product(product_id),
time_key               date 
    CONSTRAINT         not_null_time NOT NULL     
    CONSTRAINT         fk_time REFERENCES time(time_key),
customer_id            varchar2(10) 
    CONSTRAINT         not_null_customer_id NOT NULL   
    CONSTRAINT         fk_customer_id REFERENCES customer(customer_id),
purchase_date          date,
purchase_time          number(4,0),
purchase_price         number(6,2),
shipping_charge        number(5,2),
today_special_offer    varchar2(1)
    CONSTRAINT special_offer      
    CHECK (today_special_offer IN ('Y','N')) )
PARTITION BY RANGE (time_key )
(
PARTITION easy_purchases_jan_2002
  VALUES LESS THAN (TO_DATE('01-02-2002', 'DD-MM-YYYY'))
  PCTFREE 0 PCTUSED 99
  STORAGE (INITIAL 64k NEXT 16k PCTINCREASE 0)
  TABLESPACE purchases_jan2002,
PARTITION easy_purchases_feb_2002
  VALUES LESS THAN (TO_DATE('01-03-2002', 'DD-MM-YYYY'))
  PCTFREE 0 PCTUSED 99
  STORAGE (INITIAL 64k NEXT 16k PCTINCREASE 0)
  TABLESPACE purchases_feb2002,
PARTITION easy_purchases_mar_2002
  VALUES LESS THAN (TO_DATE('01-04-2002', 'DD-MM-YYYY'))
  PCTFREE 0 PCTUSED 99
  STORAGE (INITIAL 64k NEXT 64k PCTINCREASE 0)
  TABLESPACE purchases_mar2002 );

</pre>

<br/><br/>

В этом примере создали индексы сразу после определения таблицы. В реальном хранилище данных, число индексов, создаваемых до загрузки данных, сводится к абсолютному минимуму, чтобы время загрузки было как можно меньше. В результате, индексы служат только для проверки ограничений.

<br/><br/>


<pre>

-- Now create the indexes
-- Partition on the Time Key Local prefixed index
CREATE BITMAP INDEX easydw.purchase_time_index
  ON purchases (time_key ) 
LOCAL
(
partition indexJan2002 tablespace easy_purchases_jan_2002_idx,
partition indexFeb2002 tablespace easy_purchases_feb_2002_idx,
partition indexFeb2002 tablespace easy_purchases_mar_2002_idx );



CREATE BITMAP INDEX easydw.purchase_product_index
ON purchases (product_id )
local
pctfree 5 tablespace indx
storage (initial 64k next 64k pctincrease 0);

CREATE INDEX easydw.purchase_customer_index
ON purchases (customer_id )
local
pctfree 5 tablespace indx
storage (initial 64k next 64k pctincrease 0);

CREATE BITMAP INDEX easydw.purchase_special_index
ON purchases (today_special_offer )
local
pctfree 5 tablespace indx
storage (initial 64k next 64k pctincrease 0) ;



</pre>

<h2>Определение безопасности</h2>

<br/><br/>

Следующий шаг — выделить некоторые привилегии нашему пользователю EASYDW. Начнем с тех, которые позволят нам использовать Summary
Management (Управление сводками). По ходу книги мы обсудим и другие привилегии, которые нужно давать пользователям.

<br/><br/>

<pre>

connect system/manager

-- Add privileges
GRANT SELECT ANY TABLE TO easydw;
GRANT EXECUTE ANY PROCEDURE TO easydw;

-- Add privileges for summary management
GRANT CREATE ANY DIMENSION TO easydw;
GRANT ALTER ANY DIMENSION TO easydw;
GRANT DROP ANY DIMENSION TO easydw;
GRANT CREATE ANY MATERIALIZED VIEW TO easydw;
GRANT ALTER ANY MATERIALIZED VIEW TO easydw;
GRANT DROP ANY MATERIALIZED VIEW TO easydw;
GRANT QUERY REWRITE TO easydw;
GRANT GLOBAL QUERY REWRITE TO easydw;

Нужно повторить эти шаги для каждого пользователя, и, конечно, привилегии, даваемые разным пользователям, будут различаться.

</pre>

<br/><br/>

<h2>Заключительные шаги</h2>

<br/><br/>

Последний этап завершается в действительности не сейчас, а после загрузки дан-
ных. Однако мы включили его сюда, чтобы вы не забыли об этом важном шаге
анализа таблиц и индексов. Статистические данные собираются с помощью пакета
DBMS_STATS. Собранную пакетом статистику использует оптимизатор. Без
этой статистики такие возможности, как Summary Management (Управление
сводками), окажутся недоступны. Команду DBMS_STATS мы объясним в главе 3.

<br/><br/>

<pre>

-- Now Analyze the Tables and Indexes
EXECUTE dbms_stats.gather_table_stats ('EASYDW','CUSTOMER');
EXECUTE dbms_stats.gather_table_stats ('EASYDW','TODAYS_SPECIAL_OFFERS');
EXECUTE dbms_stats.gather_table_stats ('EASYDW','PRODUCT');
EXECUTE dbms_stats.gather_index_stats ('EASYDW','PURCHASE_CUSTOMER_INDEX');

</pre>

<br/><br/>


Теперь наша база данных готова. У нас есть главная основа, и в следующей главе мы узнаем, как можно расширить эту основу, включая в нее и используя возможности, имеющиеся в Oracle 9i и недоступные в более ранних версиях.

<br/><br/>
<br/><br/>







</div>		
		
	

<?php include_once "../../_footer.php"?>

</body>

</html>
