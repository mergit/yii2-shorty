Yii2 URL Shortener 
===================
Yii2 URL Shortener 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mergit/yii2-shorty "*"
```

or add

```
"mergit/yii2-shorty": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php

'components' => [

    ...

    'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    'stat/<q:\w+>'              => 'shorty/statistic/index',
                    '/<q:\w+>'                  => 'shorty/default/index',
                ],
            ],
    
        ],
        
    ...
        
    ],
    
    
Create DB

```
yii migrate --migrationPath=@vendor/mergit/shorty/migrations