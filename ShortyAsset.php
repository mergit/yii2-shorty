<?php
/**
 * Created by PhpStorm.
 * User: mer
 * Date: 01.02.18
 * Time: 14:01
 */

namespace mergit\shorty;
use yii\web\AssetBundle;

class ShortyAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/shorty/assets';
    public $css = [
        'css/main.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}