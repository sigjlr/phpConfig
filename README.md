phpConfig
=========

A simple reader of .ini configuration files.

##Install
You may install the phpConfig with [Composer](http://getcomposer.org/) (recommended) or manually.



##Usage
This example assumes you are autoloading dependencies using Composer or any other [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compliant autoloader.

```php
//Create a new PhpConfig
$config = new \PhpConfig\PhpConfig(); 

//Add any ini resources
$config->addResource('config.ini');
//You can add many resource in a single line
$config->addResource('config.ini', 'config2.ini' );

//Load the resources and produce the configuration array
//If the same key is present in many resources, the last one will be preserved.
$config->load();

//Get the configuration array
$myConfiguration = $config->getConfig();
````
To deny browser access to the .ini files add this directive in .htaccess
````
<Files *.ini> 
    Order deny,allow
    Deny from all
</Files>
````

By example consider this ini files:

Global.ini:
```ini
[Section_A]
param1 = GlobalA1
param2 = GlobalA2
```
Local.ini:
```ini
[Section_A]
param1 = LocalA1
param3 = LocalA3

[Section_B]
param1 = LocalB1
param2 = LocalB2
```
With this code:
```php
//Create a new PhpConfig
$config = new \PhpConfig\PhpConfig(); 

//Add resources
$config->addResource('Global.ini', 'Local.ini' );

$config->load();
$myConfiguration = $config->getConfig();

print_r($myConfiguration);
/*
you get this array:

Array(
  [Section_A]=>array(
    [param1] => LocalA1,
    [param2]=> globalA2,
    [param3]=> LocalA3
   ),
   [Section_B]=>array(
    [param1] => LocalB1,
    [param2]=> LocalA2
   )
)
*/
````



##License
The phpConfig is released under the MIT public license
