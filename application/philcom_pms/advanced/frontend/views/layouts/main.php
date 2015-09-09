<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
		
		
            NavBar::begin([
				'brandLabel' => 'PhilCom Projects Monitoring System',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
           
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
				$roles = Yii::$app->user->identity->roles;

				if($roles == 10){
				$menuItems[] = ['label' => 'Home', 'url' => ['site/index']];
				
				$menuItems[]=['label' => 'Administrator',
               'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Manage user', 'url' => ['/user']],
                    ['label' => 'Projects', 'url' => ['/project']],
                    ['label' => 'Account', 'url' => ['/account']],
                    ['label' => 'Malls', 'url' => ['/sitename']],
                    ['label' => 'Person in Charge', 'url' => ['/pic']],
                    ['label' => 'Logs', 'url' => ['/logs']],
                  
                ],

            ];
				}else if($roles == 20){
				$menuItems[] = ['label' => 'Home', 'url' => ['site/index']];
				$menuItems[] = ['label' => 'Projects', 'url' => ['/project']];
				
				}else if($roles == 30){
					
				$menuItems[] = ['label' => 'Home', 'url' => ['site/index']];
				}
				
                $menuItems[] = [
				
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; PhilCom <?= date('Y') ?></p>
     
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
