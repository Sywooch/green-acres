<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.05.18
 * Time: 19:36
 */

namespace shop\forms\shop\order;


use shop\entities\shop\Delivery;
use shop\entities\shop\Order\OrderGuest;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class OrderEditGuestForm
 * @package shop\forms\shop\order
 *
 */
class OrderGuestForm extends Model
{


    public $delivery;
    public $index;
    public $address;
    public $note;
    public $phone;
    public $name;




    public function rules()
    {
        return [
            [['note'], 'string'],
            [['delivery'], 'integer'],
            [['index', 'address', 'delivery'], 'required'],
            [['index'], 'string', 'min' => 6, 'max' => 6],
            [['address'], 'string'],
            [['phone', 'name'], 'required'],
            [['phone', 'name'], 'string', 'max' => 255],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'username' => 'Username',
            'delivery' => 'Варианты доставки',
            'delivery_method_name' => 'Delivery Method Name',
            'delivery_cost' => 'Delivery Cost',
            'payment_method' => 'Payment Method',
            'cost' => 'Cost',
            'note' => 'Комментарии',
            'current_status' => 'Current Status',
            'cancel_reason' => 'Cancel Reason',
            'phone' => 'Телефон',
            'name' => 'ФИО',
            'index' => 'Индекс',
            'address' => 'Адрес доставки',
        ];
    }


    /**
     * @return array
     */

    public function deliveryMethodsList()
    {
        $delivery = Delivery::find()->orderBy('sort')->all();

        return ArrayHelper::map($delivery, 'id', function (Delivery $delivery) {
            return $delivery->name . ' (' . $delivery->cost .')';
        });
    }





}