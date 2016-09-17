<?php
use yii\helpers\Html;
use common\models\Partida;
/* @var $this yii\web\View */
/* @var $partida common\models\Partida */

$this->title = 'Gomoku Game';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Gomoku Game!</h1>

        <?=Html::img('@web/img/gomoku.png', ['width'=> '150px', 'height'=>'150px'])?>

        <p class="lead">Jogo clássico para dois jogadores, onde um após o outro marca cruzes e quadrados num quadro com
            treze casas horizontais e treze verticais</p>
        <?php if (!Yii::$app->user->isGuest) {?>
            <?= Html::a('Iniciar Nova Partida', ['partida/create'], ['class' => 'btn btn-primary']) ?>
            <p class="lead">Jogadores aguardando desafiantes</p>

        <?php
            $partidas = Partida::find()->andWhere("id_user_2 is NULL")->all();
            foreach ($partidas as $partida){
                echo Html::a($partida->idUser1->username, ['partida/view', 'id'=>$partida->id]);

            }
        }
        ?>

    </div>

    <div class="body-content">

        <div class="row">

            <!--<div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>-->
        </div>

    </div>
</div>
