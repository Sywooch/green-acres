<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 27.03.18
 * Time: 21:52
 */

namespace shop\services\manage\shop;

use shop\entities\shop\product\Variant;
use shop\forms\manage\shop\product\VariantForm;
use shop\repositories\shop\CharacteristicRepository;
use shop\repositories\shop\VariantRepository;

class VariantManageService
{


    private $variants;
    private $characteristics;

    public function __construct(VariantRepository $variants, CharacteristicRepository $characteristics)
    {

        $this->variants = $variants;
        $this->characteristics = $characteristics;

    }


    public function create(VariantForm $form)
    {

        $characteristic = $this->characteristics->get($form->characteristicId);


        $variant = Variant::create(


            $characteristic->id,
            $form->variant,
            $form->sort


        );

        $this->variants->save($variant);

        return $variant;



    }


    public function update($id, VariantForm $form)
    {

        $variant = $this->variants->get($id);

        $variant->edit($form->characteristicId, $form->variant, $form->sort);

        $this->variants->save($variant);


    }



    public function remove($id)
    {
        $variant = $this->variants->get($id);

        $this->variants->remove($variant);



    }




}