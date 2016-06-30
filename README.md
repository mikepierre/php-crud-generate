# php-crud-generate 
php crud generate assist with creating CRUD classes of all your database tables in MsSQL.

#Installation
The easiest way to install is putting it in your vendor directory or whereever you house your packages.
Once you have housed this package, you can just init it by just typying in 
```php
new lib\PhpCrudGenerate($config);
```
# Code Examples
```php
//connect to database and generate all files in xml, and its classes.
$config = array(
	'database'=>array(
		'host'=>'localhost',
		'user'=>'root',
		'pass'=>'',
		'db'=>'medical'
	),
	'class_settings'=>array(
		'namespace_name'=>'medical\model' // also creates directory at root of project.
	));

//generate models with cruds
new lib\PhpCrudGenerate($config);

// init one of the generate classes
$appointment = new medical\model\appointment();

//how to use.
// read all database fields
$read = $appointment->read();
print_r($read);

// read 1 id
$appointment->where('id = 113');
$read_where = $appointment->read();
print_r($read_where);

// read several id's
$appointment->where('id IN (92,93,94)');
$read_in = $appointment->read();
print_r($read_in);

// read between id's
$appointment->where('id BETWEEN 92 AND 95');
$read_between = $appointment->read();
print_r($read_between);

// Limit from between.
$appointment->where('id BETWEEN 92 AND 95');
$appointment->limit(3,1);
$read_and_limit = $appointment->read();
print_r($read_and_limit);

//Delete 
$appointment->where('id=92');
$appointment->delete();

//Update
$array = array('2','John Doe','2015-09-06','3:00',0);
$appointment->where('id=93');
$appointment->update($array);

// Create 
$array_create = array('2','mY nAME','2015-09-06','3:00',0);
$appointment->create($array_create);
```
#Motivation