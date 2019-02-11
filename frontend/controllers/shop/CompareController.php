<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10.02.19
 * Time: 0:16
 */

namespace frontend\controllers\shop;

use Yii;
use shop\compare\Compare;
use shop\entities\shop\product\Product;
use yii\web\Controller;


class CompareController extends Controller

{
    public $compare;

    public function __construct($id,  $module,  Compare $compare, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->compare = $compare;
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {

        $compare = $this->compare->loadCompareProduct();


        return $this->render('index', [
            'compare' => $compare,

        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */

    public function actionAdd($id)
    {
        $product  = Product::find()->andWhere(['id' => $id])->one();

        try{

            $this->compare->addCompareProduct($product);

            Yii::$app->session->setFlash('success', 'Success!');
            return $this->redirect(Yii::$app->request->referrer);

        }catch (\DomainException $e) {

            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }



    }


    /**
     * @return \yii\web\Response
     */

    public function actionClearCompare()
    {

        $this->compare->clear();

        return $this->redirect(\Yii::$app->homeUrl);
    }









}