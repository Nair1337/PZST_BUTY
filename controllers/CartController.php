<?php

namespace app\controllers;

use app\models\OrderProduct;
use app\models\Product;
use Yii;
use app\models\CartProduct;
use app\models\CartProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Order;

/**
 * CartController implements the CRUD actions for CartProduct model.
 */
class CartController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'update' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CartProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CartProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CartProduct model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CartProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CartProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CartProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post_request = Yii::$app->request->post();
        if ($post_request['CartProduct']['quantity'] < 1) return $this->redirect(['index']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing CartProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheckout()
    {
        $model = new Order();
        $model->user_id = Yii::$app->user->identity->id;
        return $this->render(Yii::$app->urlManager->createUrl('cart/delivery_payment_choice'), ['model' => $model]);
    }

    public function actionCheckoutfinish()
    {
        $model = new Order();
        $model->user_id = Yii::$app->user->identity->id;
        $model->load(Yii::$app->request->post());
        return $this->render(Yii::$app->urlManager->createUrl('cart/order_summary'), ['model' => $model]);
    }

    public function actionCheckoutplaceorder()
    {
        $model = new Order();
        $model->user_id = Yii::$app->user->identity->id;
        $model->load(Yii::$app->request->post());
        $model->status = 'New';
        $model->order_date = date("Y-m-d H:i:s");
        $model->total_value = CartProduct::getSummary(Yii::$app->user->identity->id) + $model->delivery->cost;

        $model->save();

        $cartProducts = CartProduct::find()->where(['owner_id' => Yii::$app->user->identity->id])->all();

        foreach ($cartProducts as &$cp) {
            $product = Product::findOne($cp->product_id);
            $product->stock = $product->stock - $cp->quantity;
            $product->update();
            $op = new OrderProduct();
            $op->order_id = $model->id;
            $op->product_id = $cp->product_id;
            $op->quantity = $cp->quantity;
            $op->save();
            $cp->delete();
        }

        return $this->render(Yii::$app->urlManager->createUrl('site/index'));
    }

    /**
     * Finds the CartProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CartProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CartProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
