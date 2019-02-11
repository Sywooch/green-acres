<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 05.04.18
 * Time: 17:53
 */

namespace frontend\widgets\shop;


use shop\entities\shop\Category;
use shop\readModels\shop\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;

class CategoriesWidget extends Widget

{

    /** @var Category|null */

    public $active;

    private $categories;


    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);

        $this->categories = $categories;
    }


    public function run()
    {


        return Html::tag('div', implode(PHP_EOL, array_map(function (Category $category) {

            $indent = ($category->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $category->depth - 1) . '- ' : '');

            $active = $this->active && ($this->active->id == $category->id || $this->active->isChildOf($category));

            return Html::a(

                $indent. Html::encode($category->name),
                ['/shop/catalog/category', 'id' => $category->id],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        }, $this->categories->getTreeCategory($this->active))), [
            'class' => 'list-group',
        ]);


    }




}