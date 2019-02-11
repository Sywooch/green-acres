<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 20.03.18
 * Time: 17:41
 */

namespace shop\services\manage\shop;


use shop\entities\shop\Characteristic;
use shop\forms\manage\shop\CharacteristicForm;
use shop\repositories\shop\CharacteristicRepository;


/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class CharacteristicManageService
{

    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }


    public function create(CharacteristicForm $form)
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);

        return $characteristic;
    }


    public function edit($id, CharacteristicForm $form)
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id)
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }





}