<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Partida */

$this->title = $model->idUser1->username . " X ";


/*if (!$model->idUser2) {
    if (Yii::$app->user->getId() != $model->idUser1->getId()) {
        $model->id_user_2 = Yii::$app->user->getId();
        $model->save();
    }
}*/
$this->title .= $model->idUser2?$model->idUser2->username:"...";
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Insiro os estilos CSS criados para a aplicação feita em javascript
$this->registerCssFile('css/gomoku.css');
//$this->registerCssFile('js/gomoku.js');

// Carrego o javascript do jogo
//$this->registerJsFile('js/gomoku.js');

if (!$model->vencedor) {
    $this->registerJs('
    setInterval(function() {
        recarregar = document.getElementById("recarregar");
        recarregar.click();
    }, 1000);
');
}

?>

<?php Pjax::begin(); ?>
    <div class="partida-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <!-- ADICIONAR: DetailView contendo os participantes do jogo -->
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id_user_1',
                [
                    'label' => "<img id='jogador1' src ='img/X.png' width='32px' height='32px' >  Jogador 1",
                    'value' => $model->idUser1->username,
                    'format' => 'raw'
                ],

                [
                    'label' => "<img id='jogador2' src='img/O.png' width='32px' height='32px' >  Jogador 2",
                    'value' => ($model->idUser2 == null)?"Aguardando...":$model->idUser2->username,
                    'format' => 'raw'
                ],

                [
                    'attribute' => 'Vencedor',
                    'value' => ($model->vencedor == null )? "Vencedor não definido" : $model->vencedor0->username,
                ],
            ],
        ]) ?>
        <?php
            if($model->id_user_1 == $jogador_da_vez){
                $this->registerJs(
                    "document.getElementById('jogador1').style.opacity = 1;
                    document.getElementById('jogador2').style.opacity = 0.3;"
                );
            } else{
                $this->registerJs(
                    "document.getElementById('jogador2').style.opacity = 1;
                    document.getElementById('jogador1').style.opacity = 0.3;"
                );
            }

        ?>

        <!-- Link usado pelo Pjax, para carregar o tabuleiro a cada segundo -->
        <?= Html::a('Recarregar',['partida/view','id'=>$model->id],['id'=>'recarregar','style'=>'display:none']) ?>
        <div class="container">
            <table class='tabuleiro' id="tabela">
                <?php
                $caminho= Url::canonical();
                $evento = "";
                for ($row = 0; $row < 15; $row++){
                    echo "<tr>";
                    for ($col = 0; $col < 15; $col++) {
                        echo "<td>";
                        if (isset($jogadas)){
                                if ($jogadas[$row][$col]==$model->id_user_1){?>
                                    <a href="" onclick=""><img src="img/X.png" width="32px" height="32px"></a>

                            <?php
                                } else if ($jogadas[$row][$col]==$model->id_user_2 && $model->idUser2 != null){?>
                                    <a href="" onclick=""><img src="img/O.png" width="32px" height="32px"></a>
                            <?php
                                } else{
                                    if (isset($jogador_da_vez)){
                                        if ($jogador_da_vez == Yii::$app->user->getId() && !$vencedor) {
                                            $evento = "clique($row, $col, '$caminho')";
                                        }
                                    }
                                    ?>

                                    <a href="" onclick="<?=$evento?>"><img src="img/rosa.jpg" width="32px" height="32px"></a>
                            <?php
                                }
                            }else{
                                if (isset($jogador_da_vez)){
                                    if ($jogador_da_vez == Yii::$app->user->getId() && !$vencedor) {
                                        $evento = "clique($row, $col, '$caminho')";
                                    }
                                }
                            ?>

                                <a href="" onclick="<?=$evento?>"><img src="img/rosa.jpg" width="32px" height="32px"></a>
                        <?php
                            }
                        ?>


                        <?php
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>


            </table>

        </div>

    </div>

<?php Pjax::end(); ?>

<script>

    function clique(linha, coluna, base){
        window.location.href= base+ '&linha='+linha+'&coluna='+coluna;
    }


</script>
