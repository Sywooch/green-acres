<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 30.05.18
 * Time: 15:50
 */

namespace backend\controllers\shop;


use shop\entities\shop\order\Order;
use shop\entities\shop\Order\OrderGuest;
use shop\forms\manage\shop\order\OrderEditForm;
use shop\forms\shop\order\OrderGuestForm;
use Yii;
use backend\forms\shop\OrderSearch;
use shop\services\manage\shop\OrderManageService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{

    private $service;

    public function __construct($id, $module, OrderManageService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;

    }


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'export' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @return $this
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */

    public function actionExport()
    {

        $query = Order::find()->orderBy(['id' => SORT_DESC]);

        $objPHPExcel = new \PHPExcel();


        $worksheet = $objPHPExcel->getActiveSheet();

        foreach ($query->each() as $row => $order) {

            $worksheet->setCellValueByColumnAndRow(0, $row + 1, $order->id);
            $worksheet->setCellValueByColumnAndRow(1, $row + 1, date('Y-m-d H:i:s', $order->created_at));

        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //$pdf = new \PHPExcel_Writer_PDF($objPHPExcel);


        $file = tempnam(sys_get_temp_dir(), 'export');
        $objWriter->save($file);

        return Yii::$app->response->sendFile($file, 'report.xlsx');


    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'order' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */

    public function actionUpdate($id)
    {
        $order = $this->findModel($id);

        $form = new OrderGuestForm($order);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($order->id, $form);
                return $this->redirect(['view', 'id' => $order->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'order' => $order,
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


}