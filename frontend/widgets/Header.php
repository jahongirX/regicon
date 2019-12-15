<?php
namespace frontend\widgets;

class Header extends \yii\base\Widget
{
    public function run(){
        return $this->render('header');
    }
}