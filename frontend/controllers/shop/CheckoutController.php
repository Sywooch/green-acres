<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10.02.19
 * Time: 23:50
 */

namespace frontend\controllers\shop;

use shop\cart\Cart;
use shop\entities\shop\Order\OrderGuest;
use yii\web\NotFoundHttpException;
use Yii;
use shop\forms\shop\order\OrderGuestForm;
use shop\services\shop\OrderGuestService;
use yii\web\Controller;

class CheckoutController extends Controller
{


    public $layout = 'blank';

    private $service;
    private $cart;


    public function __construct($id, $module, Cart $cart, OrderGuestService $service, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->cart = $cart;
        $this->service = $service;
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        $form = new OrderGuestForm();
        $cart = $this->cart->loadCartItems();
        $totalCount = $this->cart->totalCount();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $newOrder = $this->service->checkoutGuest($form, $cart, $totalCount);
                Yii::$app->session->setFlash('success', 'Ваш заказ оформлен!');
                $random = Yii::$app->getSecurity()->generateRandomKey(5);
                return $this->redirect(['view', 'id' => $newOrder->id, 'random' =>$random]);

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

    /**
     * @param $id
     * @param $random
     * @return string
     */

    public function actionView($id, $random)
    {

        return $this->render('view', [
            'order' => $this->findModel($id),
            'random' =>$random
        ]);
    }


    /**
     * @param integer $id
     * @return OrderGuest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderGuest::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return $this
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */

    public function actionExport($id)
    {

        $order = OrderGuest::findOne($id);

        $objPHPExcel = new \PHPExcel();

        $worksheet = $objPHPExcel->getActiveSheet();

        $worksheet->setCellValue('A1', 'ID');
        $worksheet->setCellValue('A2', 'Дата создания заказа');
        $worksheet->setCellValue('A3', 'Доставка');
        $worksheet->setCellValue('A4', 'Оплата');
        $worksheet->setCellValue('A5', 'Стоимость заказа с доставкой');

        $worksheet->setCellValueByColumnAndRow(4, 1, $order->id);
        $worksheet->setCellValueByColumnAndRow(4, 2, date('Y-m-d H:i:s', $order->created_at));

        $worksheet->setCellValueByColumnAndRow(4, 3, $order->delivery_method_name);

        $worksheet->setCellValueByColumnAndRow(4, 4, $order->payment_method);
        $worksheet->setCellValueByColumnAndRow(4, 5, $order->cost);



        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //$pdf = new \PHPExcel_Writer_PDF($objPHPExcel);

        $file = tempnam(sys_get_temp_dir(), 'export');
        $objWriter->save($file);

        return Yii::$app->response->sendFile($file, 'Заказ семян.xlsx');

    }


}
