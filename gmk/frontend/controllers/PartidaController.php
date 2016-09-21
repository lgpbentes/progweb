<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use common\models\Partida;
use common\models\PartidaSearch;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Jogada;

/**
 * PartidaController implements the CRUD actions for Partida model.
 */
class PartidaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Partida models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partida model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $linha=NULL, $coluna=NULL)
    {
        // Carregando o modelo de Partidas
        $model = $this->findModel($id);

        // Verificando se o usuário corrente (Yii::$app->user->id)
        // já está participando do jogo corrente. Se não estiver
        // participando, eu incluo o usuário na partida.
        if ($model->id_user_1 != Yii::$app->user->id && !$model->id_user_2) {
            $model->id_user_2 = Yii::$app->user->id;
            $model->save();
        }

        // Se a linha/coluna foi enviada via PJAX, quer dizer que o
        // usuário corrente fez uma jogada. Desta forma, eu
        // adiciono a jogada do usuário na tabela jogada.

        $jogada_model = new Jogada();
        if ($linha!=NULL && $coluna!=NULL) {
            $jogada_model->id_user = Yii::$app->user->id;
            $jogada_model->id_partida = intval($id);
            $jogada_model->linha = intval($linha);
            $jogada_model->coluna = intval($coluna);
            try{
                $jogada_model->save(false);
            } catch (Exception $e){
            }
        }

        // Carrego todas as jogadas da presente partida na variável $jogadas
        $jogadas = Jogada::find()->where(['id_partida'=>$id])->orderBy('id ASC')->all();

        $ultimo_jogador = $model->id_user_2;

        $jogadas_array = [];

        // Inicializo todas as casas do vetor com zero.
        for ($row=0; $row<15; $row++) {
            for ($col=0; $col<15; $col++) {
                $jogadas_array[$row][$col] = 0;
            }
        }

        foreach ($jogadas as $jogada) {
            $jogadas_array[$jogada->linha][$jogada->coluna] = $jogada->id_user;
            // O valor de $ultimo_jogador será igual ao do usuário da última jogaad
            $ultimo_jogador = $jogada->id_user;
        }
        $vencedor = null;
        if($jogada_model->linha!=NULL && $jogada_model->coluna!=NULL){
            $vencedor = $this->verificaVencedor($jogada_model->linha, $jogada_model->coluna,$jogadas_array,$ultimo_jogador);
        }
        if ($vencedor) {
            $model->vencedor = $vencedor;
            $model->save();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'jogadas' => $jogadas_array,
            'vencedor' => $vencedor
        ]);



    }

    public function verificaVencedor($posX, $posY, $tabuleiro, $ultimo_jogador) {
        //verifica na horizontal
        Yii::error('posX', $posX);
        Yii::error('posY', $posY);

        $iguais = 0;
        for($y = 0; $y < 15; $y++){

                if ($tabuleiro[$posX][$y] == $ultimo_jogador) {
                    $iguais = $iguais + 1;
                } else {
                    $iguais = 0;
                }
                Yii::error('iguais', $iguais);
                if ($iguais == 5) {
                    return User::findOne($ultimo_jogador);
                }

        }

        //verifica na vertical
        /*$iguais = 0;
        for($x = 0; $x < 15; $x++){
            if($tabuleiro[$x][$posY] == $ultimo_jogador){
                $iguais = $iguais+1;
            } else{
                $iguais=0;
            }

            if($iguais==5){
                return true;
            }
        }*/

        return null;
    }

    /**
     * Creates a new Partida model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$model = Partida::find()->where(['id_user_1'=>Yii::$app->user->id])->andWhere('vencedor IS NULL')->one();


            $model = new Partida();
            $model->id_user_1 = Yii::$app->user->id;
            $model->save();


        return $this->redirect(['partida/view', 'id' => $model->id]);
    }

    /**
     * Updates an existing Partida model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Partida model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partida::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
