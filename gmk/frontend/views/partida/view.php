<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Partida */

$this->title = $model->idUser1->username . " X ";

if (!$model->idUser2) {
    if (Yii::$app->user->getId() != $model->idUser1->getId()) {
        $model->id_user_2 = Yii::$app->user->getId();
        $model->save();
    }
}
$this->title .= $model->idUser2?$model->idUser2->username:"...";
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Insiro os estilos CSS criados para a aplicação feita em javascript
$this->registerCssFile('css/gomoku.css');

// Carrego o javascript do jogo
//$this->registerJsFile('js/gomoku.js');

/*$vencedor = 0;
if (!$vencedor) {
    $this->registerJs('
    setInterval(function() {
        recarregar = document.getElementById("recarregar");
        recarregar.click();
    }, 1000);
');
}*/

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
                    'attribute' => 'Jogador 1',
                    'value' => $model->idUser1->username,
                ],

                [
                    'attribute' => 'Jogador 2',
                    'value' => ($model->idUser2 == null)?"Aguardando...":$model->idUser2->username,
                ],
                [
                    'attribute' => 'Vencedor',
                    'value' => ($model->vencedor == null )? "Vencedor não definido" : $model->vencedor->username,
                ],
            ],
        ]) ?>

        <!-- Link usado pelo Pjax, para carregar o tabuleiro a cada segundo -->
        <div class="container">
            <table class='tabuleiro' id="tabela">
                <?php
                for ($row = 0; $row < 15; $row++){
                    echo "<tr>";
                    for ($col = 0; $col < 15; $col++){
                        echo "<td>";
                        echo Html::img('@web/img/rosa.jpg', ['width'=> '30px', 'height'=>'30px']);
                        //echo Html::a('Jogada', ['partida/view']);
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>

                <!-- ADICIONAR: Tabuleiro do Jogo
                     Cada campo do tabuleiro deverá conter um link que irá direcionar
                     o usuário para o seguinte endereço: ['partida/view','id'=>$model->id,'linha'=>$row,'coluna'=>$col].
                     Note que o endereço acima chama a action partida/view, e informa a action
                     sobre qual campo (linha/coluna) do tabuleiro foi clicado. Note também que esse link
                     está dentro de Pjax::begin() e Pjax:end(), e por isso, ao ser clicado, ele
                     irá disparar uma chamada Pjax, de forma que apenas a região do tabuleiro
                     será recarregada.
                -->
            </table>

        </div>

    </div>
<?php Pjax::end(); ?>