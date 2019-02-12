<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10.02.19
 * Time: 23:50
 */

namespace frontend\controllers\shop;

use shop\cart\Cart;
use Yii;
use shop\forms\shop\order\OrderGuestForm;
use shop\services\shop\OrderGuestService;
use yii\web\Controller;

class CheckoutController extends Controller
{


    public $layout = 'blank';

    private $service;
    private $cart;


    public function __construct($id, $module,  Cart $cart, OrderGuestService $service, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->cart= $cart;
        $this->service = $service;
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {

        $form = new OrderGuestForm();
        $cart = $this->cart->loadCartItems();
        $totalCount = $this->cart->totalCount();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                 $this->service->checkoutGuest($form, $cart, $totalCount);
                Yii::$app->session->setFlash('success', 'Ваш заказ оформлен!');
                $this->cart->clear();
                return $this->goHome();

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'cart' => $cart,
           'totalCount' => $totalCount,
            'model' => $form
        ]);
    }










}
