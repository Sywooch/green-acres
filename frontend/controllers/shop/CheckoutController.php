<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10.02.19
 * Time: 23:50
 */

namespace frontend\controllers\shop;

use Yii;
use shop\forms\shop\order\OrderGuestForm;
use shop\services\shop\CartService;
use shop\services\shop\OrderGuestService;
use yii\web\Controller;

class CheckoutController extends Controller
{


    public $layout = 'blank';

    private $service;
    private $cartService;


    public function __construct($id, $module,  CartService $cartService, OrderGuestService $service, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->cartService = $cartService;
        $this->service = $service;
    }


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->cartService->getCart();
        $totalCount = $this->cartService->getTotal();
        $form = new OrderGuestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                 $this->service->checkoutGuest($form);
                Yii::$app->session->setFlash('success', 'Ваш заказ оформлен!');
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
