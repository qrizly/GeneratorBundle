AvroGeneratorBundle
-------------------
Generate Symfony2 code from the command line!
With this bundle you can generate or update 
all classes related to an entity with just a few commands!

This bundle generates code that is customised to my personal 
preferences so it won't be for everyone. However, I am open 
to collaborating with others in improving this bundle and 
making it more suitable for more people. 

Status
------
The bundle is a work in progress but is working...most of the time :) 
Currently it only provides support for Doctrine ORM. 

The code still needs to get cleaned up a fair bit but the code that 
it does generate is pretty solid. 

Any help would be much appreciated!

Styles
------
Currently, two "styles" of code are supported. 

###FOS 
Generates <a href="https://github.com/FriendsOfSymfony/FOSUserBundle">FOSUserBundle</a> inspired code.

###Knockout
Implements <a href="http://knockoutjs.com">KnockoutJS</a> in the view layer along 
with FOSUserBundle inspired code.
Generates data-binds in the form classes as well as viewModels.

Dependencies
------------
###FOS
- None

###Knockout
- <a href="http://knockoutjs.com">KnockoutJS</a>
- <a href="http://jquery.com">JQuery</a>
- <a href="http://jquery.malsup.com/form/">JQuery Form Plugin</a>
- <a href="https://github.com/schmittjoh/JMSSerializerBundle">JMSSerializerBundle</a>
- some custom javascript functions, I will create a bundle of these soon

Optional Dependencies
---------------------
- The view generator generates some <a href="http://jqueryui.com">JQueryUI</a> classes
- Form fields have classes that work with <a href="http://bassistance.de/jquery-plugins/jquery-plugin-validation/">JQuery Validation</a>
- The CSV importer requires <a href="https://github.com/jdewit/AvroCsvBundle">AvroCsvBundle</a>

USAGE
-----
Enter the following commands in the console and follow the prompts!

Generate a bundle skeleton with:

``` bash
$ php app/console generate:avro:bundle
```

Generate all code for all mapped entities in the entire application with:

``` bash
$ php app/console generate:avro:build
```

Generate all code for a given entity with:

``` bash
$ php app/console generate:avro:all
```

Generate an entity and entityManager with:

``` bash
$ php app/console generate:avro:entity
```

Generate a controller and views with:

``` bash
$ php app/console generate:avro:crud
```

Generate a controller with:

``` bash
$ php app/console generate:avro:controller
```

Generate views with:

``` bash
$ php app/console generate:avro:view
```

Generate a formType and formHandler with:

``` bash
$ php app/console generate:avro:form
```

Generate a Dependency Injection configuration file for supported services:

``` bash
$ php app/console generate:avro:service
```

Generate behat features with:

``` bash
$ php app/console generate:avro:feature
```

Generate csv importer with:
*requires AvroCsvBundle

``` bash
$ php app/console generate:avro:import
```

Installation
------------
Add the `Avro` namespace to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    'Avro' => __DIR__.'/../vendor/bundles',
));
```

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        ...
        $bundles[] = new Avro\GeneratorBundle\AvroGeneratorBundle();
    }
```

Add to deps file
    
```
[AvroGeneratorBundle]
    git=git://github.com/jdewit/AvroGeneratorBundle.git
    target=bundles/Avro/GeneratorBundle
```

Now, run the vendors script to download the bundle:

``` bash
$ bin/vendors update
```

SOMEDAY FEATURES
----------------
- Improve compatibility 
- MongoDB support
- CouchDB support
