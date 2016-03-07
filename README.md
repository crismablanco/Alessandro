# System 

- The system is a localhost app that is used to manage job orders for machines and customers
- You have N number of machines and clients.
- Each machine "starts" its own job with a client and when the job is done, the worker set the job "stopped".
- Then a new record is stored on the DB: Machine_id ** // Customer_id ** // Date_Time_Start ** // Date_Time_Finish **
- There is a manager page too, where you can see the activities of all machines.

## Resume

The machine operators uses tablets.
They choose a clientX and clicks "start"
Then the clientX is in second column in yellow.
When job is finished, the operator clicks the clientX in second column and clicks "stop".

# Setup
- Import the `system.sql`
- Configure the `configdb.ini` 

#Live Demo:
- [Front](http://crismablanco.com/clialessandro/index.php?machine=2)
- [admin](http://crismablanco.com/clialessandro/admin/machines.html)
- [Manager](http://crismablanco.com/clialessandro/general.php)

#Technology
- PHP
- MySQL
- DB class
- [normalize.css](https://necolas.github.io/normalize.css/)
- [Bootstrap Responsive](http://getbootstrap.com/)
- [DataTables JQuery Plugin](http://www.datatables.net/)
