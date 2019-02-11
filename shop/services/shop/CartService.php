<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 07.04.18
 * Time: 14:21
 */

namespace shop\services\shop;


use shop\cart\Cart;
use shop\cart\CartItem;

use shop\repositories\shop\ProductRepository;
use yii\web\Session;


class CartService

{
    /**
     * @var Cart
     *
     */

    private $cart;
    private $products;


    /**
     * CartService constructor.
     * @param Cart $cart
     * @param ProductRepository $products
     */
    public function __construct(Cart $cart, ProductRepository $products)
    {

        $this->cart = $cart;
        $this->products = $products;



    }

    /**
     * @return mixed
     */

    public function getCart()
    {
         return $this->cart->loadCartItems();
    }


    /**
     * @param $product
     * @param $quantity
     */

    public function add($product, $quantity)
    {
       $this->cart->addCart($product, $quantity);
    }

    /**
     * @param $id
     * @param $quantity
     */

   public function addQuantity($id, $quantity)
   {

       $this->cart->addQuantity($id, $quantity);

   }

    /**
     * @return int
     */
    public function getTotal()

    {
        return $this->cart->totalCount();
    }

    /**
     * @param $id
     */

    public function remove($id)
    {
        $this->cart->remove($id);
    }


    /**
     *
     */

    public function clear()
    {

       $this->cart->clear();
    }






}