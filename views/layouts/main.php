<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?php echo ($this->title == 'ІС медичного контролю') ? 'mainpage':'';?>">
<?php $this->beginBody() ?>

<div class="wrap">
    
    <?php
    if($this->title == 'ІС медичного контролю'){
        echo "<h1 class='mainTitle'>ІС медичного контролю</h1>";
    }else{
    NavBar::begin([
        'brandLabel' => 'ІС медичного контролю',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top fa fa-stethoscope',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Люди', 'url' => ['/peoples'],
                'items' =>[
                    ['label' => 'Перегляд', 'url' => ['/peoples']],
                    ['label' => 'Додавання', 'url' => ['/peoples/create']],
                    ['label' => 'Друк', 'url' => ['/peoples/pprint']]
                ]                
            ],
            ['label' => 'Вулиці', 'url' => ['/streets']],
            ['label' => 'Місця роботи', 'url' => ['/working']],
            ['label' => 'Щеплення', 'url' => ['/grafts']],
            ['label' => 'Захворювання', 'url' => ['/chronic_diseases']],
            ['label' => 'Пошук за датою', 'url' => ['/peoples/flu']],
            ['label' => 'Зберегти БД', 'url' => ['/peoples/backup']],
        ],
    ]);
    NavBar::end();
    
    }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
