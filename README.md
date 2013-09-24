phpConfig
=========

A simple reader of configuration files

##Usage

````
\\Create a new PhpConfig
$config = new \PhpConfig\PhpConfig(); 


\\Add a list of ini resources
$config->addResource(__DIR__.'/appconfig.ini', __DIR__.'/appconfig2.ini');


\\Load the resources and make the configuration array
$config->load();


\\Get the configuration array
$config->getConfig();
````

If the .ini files must be fobidden by browser add this directive in .htaccess
````
<Files *.ini> 
    Order deny,allow
    Deny from all
</Files>
````