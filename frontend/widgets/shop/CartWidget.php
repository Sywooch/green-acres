<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.05.18
 * Time: 10:41
 */

namespace frontend\widgets\shop;


use shop\cart\Cart;
use yii\base\Widget;

class CartWidget extends Widget
{

    private $cart;

    public function __construct(Cart $cart, array $config = [])
    {
        parent::__construct($config);

        $this->cart = $cart;
    }


    public function run()
    {

        return $this->render('cart', ['cart' => $this->cart]);


    }


}