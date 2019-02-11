<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.02.19
 * Time: 13:20
 */

namespace frontend\controllers\shop;



use shop\forms\shop\AddToCartForm;
use Yii;
use shop\entities\shop\product\Product;
use shop\readModels\shop\ProductReadRepository;
use shop\services\shop\CartService;
use yii\filters\VerbFilter;
use yii\web\Controller;


class CartController extends Controller
{
    public $layout = 'blank';

    private $products;
    private $service;

    public function __construct($id, $module, CartService $service, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->products = $products;
        $this->service = $service;
    }



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add-quantity' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->service->getCart();
        $totalCount = $this->service->getTotal();

        return $this->render('index', [
            'cart' => $cart,
            'total' => $totalCount
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
            $this->service->add($product, 1);
            Yii::$app->session->setFlash('success', 'Success!');
            return $this->redirect(Yii::$app->request->referrer);

        }catch (\DomainException $e) {

            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }


        $this->layout = 'blank';

        $form = new AddToCartForm($product);


        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->add($product, $form->quantity);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }


    public function actionAddQuantity($id)
    {
        try{
            $this->service->addQuantity($id, (int)Yii::$app->request->post('addQuantity'));

        }catch (\DomainException $e) {

            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }



    /**
     * @param $id
     * @return \yii\web\Response
     */

    public function actionRemove($id)
    {
        try{

            $this->service->remove($id);
        } catch(\DomainException $e) {

            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);

    }


    /**
     * @return \yii\web\Response
     */

    public function actionClearCart()
    {

        $this->service->clear();

        return $this->redirect(\Yii::$app->homeUrl);
    }


}