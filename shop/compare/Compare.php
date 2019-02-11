<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 09.02.19
 * Time: 23:57
 */

namespace shop\compare;

use Yii;

class Compare
{
    private $compareProduct;


    /**
     * @param $product
     */
    public function addCompareProduct($product)
    {

        $this->loadCompareProduct();

        $id = md5(serialize([$product->id, $product->code]));

        foreach ($this->compareProduct as $i => $item) {

            if ($item['id'] == $id) {

                return;
            }
        }

        $this->compareProduct[] = [

            'id' => $id,
            'product' => $product,

        ];

        $this->saveCompareProduct();

    }


    /**
     *
     */

    public function clear()
    {
        $this->compareProduct = [];

        $this->saveCompareProduct();
    }



    /**
     *
     */

    public function saveCompareProduct()
    {

        Yii::$app->session->set('compare', $this->compareProduct);

    }

    /**
     * @return mixed
     */

    public function loadCompareProduct()
    {
        if ($this->compareProduct === null) {

            return $this->compareProduct = \Yii::$app->session->get('compare', []);
        }

    }


}