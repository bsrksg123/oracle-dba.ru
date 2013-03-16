<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h1>Oracle RAC 11G R2:</h1>
<br/><br/>

<span style="font-family: 'Courier New',Courier,monospace;">Oracle Real Application Clusters (RAC)&nbsp;</span><span style="font-family: 'Courier New',Courier,monospace;">Specific</span><span style="font-family: 'Courier New',Courier,monospace;">&nbsp;</span><span style="font-family: 'Courier New',Courier,monospace;">Background
Processes</span></span></b><br>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">Oracle
RAC is composed of two or more database instances. They are composed of memory
structures and background processes same as the single instance database.<o:p></o:p></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span><br>
<span style="font-family: 'Courier New',Courier,monospace;">Oracle
RAC instances are composed of following background processes:<br>
ACMS &nbsp; &nbsp;— Atomic Control file to Memory Service (ACMS)<br>
GTX0-j &nbsp;— Global Transaction Process<br>
LMON &nbsp; &nbsp;— Global Enqueue Service Monitor<br>
LMD &nbsp; &nbsp; — Global Enqueue Service Daemon<br>
LMS &nbsp; &nbsp; — Global Cache Service Process<br>
LCK0 &nbsp; &nbsp;— Instance Enqueue Process<o:p></o:p></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">DIAG &nbsp; &nbsp;</span><span style="font-family: 'Courier New',Courier,monospace;">—&nbsp;</span><span style="font-family: 'Courier New',Courier,monospace;">Diagnosability Daemon<br>
RMSn &nbsp; &nbsp;— Oracle RAC Management Processes (RMSn)<br>
RSMN &nbsp; &nbsp;— Remote Slave Monitor<o:p></o:p></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span><br>
<span style="font-family: 'Courier New',Courier,monospace;">These processes spawned for supporting the
multi-instance coordination.<o:p></o:p></span></div>
<div style="line-height: 13.5pt; margin: 0cm;">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">ACMS </span>(from Oracle 11g)&nbsp;</b><br>
ACMS stands for Atomic Control file Memory Service. In an Oracle RAC
environment ACMS is an agent that ensures a distributed SGA memory update(ie) SGA
updates are globally committed on success or globally aborted in event of a
failure.<br>
<br>
<o:p></o:p></span></div>
<div style="line-height: 13.5pt; margin: 0cm;">
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">GTX0-j</span></b></span>
<b style="font-family: 'Courier New',Courier,monospace;"><span style="font-size: large;">&nbsp;</span>(from&nbsp;Oracle 11g)&nbsp;</b><span style="font-family: 'Courier New',Courier,monospace;"><br>
The process provides transparent support for XA global transactions in a RAC
environment. The database auto tunes the number of these processes based on the
workload of XA global transactions.<o:p></o:p></span></div>
<div class="MsoNormal">
<b><span style="font-family: 'Courier New',Courier,monospace;"><br></span></b><br>
<b><span style="font-family: 'Courier New',Courier,monospace;"><span style="font-size: large;">LMON</span><span class="apple-converted-space"><o:p></o:p></span></span></b></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">The
Global Enqueue Service Monitor (LMON), monitors the entire cluster to manage
the global enqueues and the resources and performs global enqueue
recovery operations. LMON manages instance and process failures and the
associated recovery for the Global Cache Service (GCS) and Global Enqueue
Service (GES). In particular, LMON handles the part of recovery associated with
global resources. LMON provided services are also known as cluster group
services (CGS).&nbsp;<o:p></o:p></span><span style="background-color: white; line-height: 18px;"><span style="font-family: 'Courier New',Courier,monospace;">Lock monitor manages global locks and resources. It handles the redistribution of instance locks whenever instances are started or shutdown. Lock monitor also recovers instance lock information prior to the instance recovery process. Lock monitor co-ordinates with the Process Monitor (PMON) to recover dead processes that hold instance locks.</span></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><b><br></b></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">LMDx</span></b><span class="apple-converted-space"><o:p></o:p></span></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">The
Global Enqueue Service Daemon (LMD) is the lock agent process that manages
enqueue manager service requests for Global Cache Service enqueues to control
access to global enqueues and resources. This process&nbsp;manages
incoming remote resource requests within each instance. The LMD process
also handles deadlock detection and remote enqueue requests. Remote resource
requests are the requests originating from another instance.&nbsp;<o:p></o:p></span><span style="background-color: white; line-height: 18px;"><span style="font-family: 'Courier New',Courier,monospace;">LMDn processes manage instance locks that are used to share resources between instances. LMDn processes also handle deadlock detection and remote lock requests.</span></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><b><br></b></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">LMSx</span></b><span class="apple-converted-space"><o:p></o:p></span></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">The
Global Cache Service Processes (LMSx) are the processes that handle remote
Global Cache Service (GCS) messages. Real Application Clusters software
provides for up to 10 Global Cache Service Processes. The number of LMSx varies
depending on the amount of messaging traffic among nodes in the cluster.<o:p></o:p></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><br></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">This
process maintains statuses of datafiles and each cached block by recording
information in a Global Resource Directory(GRD). This process also controls the
flow of messages to remote instances and manages global data block access and
transmits block images between the buffer caches of different instances. This
processing is a part of cache fusion feature.<o:p></o:p></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><br></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">The
LMSx handles the acquisition interrupt and blocking interrupt requests from the
remote instances for Global Cache Service resources. For cross-instance
consistent read requests, the LMSx will create a consistent read version of the
block and send it to the requesting instance. The LMSx also controls the flow
of messages to remote instances.<o:p></o:p></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><br></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">The
LMSn processes handle the blocking interrupts from the remote instance for the
Global Cache Service resources by:<o:p></o:p></span></div>
<ul type="disc">
<li class="MsoNormal"><span style="font-family: 'Courier New',Courier,monospace;">Managing
     the resource requests and cross-instance call operations for the shared
     resources.<br>
     &nbsp;<o:p></o:p></span></li>
<li class="MsoNormal"><span style="font-family: 'Courier New',Courier,monospace;">Building
     a list of invalid lock elements and validating the lock elements during
     recovery.<br>
     &nbsp;<o:p></o:p></span></li>
<li class="MsoNormal"><span style="font-family: 'Courier New',Courier,monospace;"><span style="color: windowtext;">Handling the global lock deadlock detection and
     Monitoring for the lock conversion timeouts.</span><o:p></o:p></span></li>
</ul>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;"><br></span></b></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">LCKx</span></b><span class="apple-converted-space"><o:p></o:p></span></span></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">This
process manages the global enqueue requests and the cross-instance broadcast.
Workload is automatically shared and balanced when there are multiple Global
Cache Service Processes (LMSx). This process is called as instance
enqueue process. This process manages non-cache fusion resource requests such
as library and row cache requests.&nbsp;<o:p></o:p></span><span style="background-color: white; font-family: 'courier new'; line-height: 18px;">The instance locks that are used to share resources between instances are held by the lock processes.</span></div>
<div class="MsoNormal">
<b><span style="font-family: 'Courier New',Courier,monospace;"><br></span></b><br>
<b><span style="font-family: 'Courier New',Courier,monospace; font-size: large;">DIAG</span></b></div>
<div class="MsoNormal">
<span style="font-family: 'Courier New',Courier,monospace;">Diagnosability
Daemon – Monitors the health of the instance and captures the data for instance
process failures.<o:p></o:p></span></div>
<div style="line-height: 13.5pt; margin: 0cm;">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">RMSn</span></b><br>
This process is called as Oracle RAC Management Service/Process. These processes
perform manageability tasks for Oracle RAC. Tasks include creation of resources
related Oracle RAC when new instances are added to the cluster.<br>
<br>
<o:p></o:p></span></div>
<div style="line-height: 13.5pt; margin: 0cm;">
<span style="font-family: 'Courier New',Courier,monospace;"><b><span style="font-size: large;">RSMN</span></b><br>
This process is called as Remote Slave Monitor. This process manages background
slave process creation and communication on remote instances. This is a
background slave process. This process performs tasks on behalf of a
coordinating process running in another instance.</span><span style="color: rgb(51, 51, 51); font-family: Arial; font-size: 10.5pt;"><o:p></o:p></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><br></span><br>
<span style="font-family: 'Courier New',Courier,monospace;"><span style="line-height: normal;">Oracle RAC instances use two processes GES(Global Enqueue Service), GCS(Global Cache Service) that enable cache fusion.&nbsp;</span><span style="line-height: 13.5pt;">The GES and GCS maintain records of the statuses of each datafile
and each cached block using global resource directory (GRD). This process is referred
to as cache fusion and helps in data integrity.</span></span><br>
<div style="line-height: 13.5pt; margin: 0cm;">
<span style="font-family: 'Courier New',Courier,monospace;"><br></span></div>
<span style="font-family: 'Courier New',Courier,monospace;"><span style="line-height: 13.5pt;">Oracle RAC is composed of two or more instances. When a block of data is read
from datafile by an instance within the cluster and another instance is in need
of the same block, it is easy to get the block image from the instance which
has the block in its SGA rather than reading from the disk. To enable inter instance
communication Oracle RAC makes use of interconnects. The Global Enqueue
Service(GES) monitors and Instance enqueue process manages the cache fusion</span><span style="line-height: normal;">.</span></span>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
