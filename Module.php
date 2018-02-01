<?php

namespace mergit\shorty;
use Yii;

/**
 * shorty module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'mergit\shorty\controllers';
    public $defaultRoute = 'default';
    public $layout = 'shorty';
    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();
        \Yii::configure($this, require __DIR__ . '/config/main.php');


        // custom initialization code goes here
    }
}
