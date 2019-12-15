<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "fonts/stylesheet.css",
        "plugins/custom/fullcalendar/fullcalendar.bundle.css",
        "plugins/global/plugins.bundle.css",
        "css/style.bundle.css",
        "css/site.css",
    ];
    public $js = [
//        'js/options.js',
//        "plugins/global/plugins.bundle.js",
//        "js/scripts.bundle.js",
//        "plugins/custom/fullcalendar/fullcalendar.bundle.js",
//        "plugins/custom/gmaps/gmaps.js",
//        "js/pages/dashboard.js",
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}