Yii2 URL Shortener 
===================
Yii2 URL Shortener 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mergit/yii2-shorty "dev-master"
```

or add

```
"mergit/yii2-shorty": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php

$config = [
    'defaultRoute' => 'shorty/default/index',

	'components' => [
		'geoip' => ['class' => 'lysenkobv\GeoIP\GeoIP'],
	],

	'modules' => [

		'shorty' => [
		    'class' => 'mergit\shorty\Module',
		],
    
	],
];

```    


Create DB
---


```
yii migrate --migrationPath=@vendor/mergit/shorty/migrations
```