<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 19.03.18
 * Time: 17:24
 */

namespace shop\entities\shop;

use paulzi\nestedsets\NestedSetsBehavior;
use shop\entities\shop\queries\CategoryQuery;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{

    public $category;
    public $count;





    public static function tableName()
    {
        return '{{%shop_categories}}';
    }

    public function behaviors()
    {
        return [

            NestedSetsBehavior::class,

            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                'immutable' => false

            ]

        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    public static function create($name, $title, $description, $meta_title, $meta_description, $meta_keywords)
    {
        $category = new static();

        $category->name = $name;
        $category->title = $title;
        $category->description = $description;
        $category->meta_title = $meta_title;
        $category->meta_description = $meta_description;
        $category->meta_keywords = $meta_keywords;

        return $category;


    }

    public function edit($name, $title, $description, $meta_title, $meta_description, $meta_keywords)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->meta_title = $meta_title;
        $this->meta_description = $meta_description;
        $this->meta_keywords = $meta_keywords;
    }






    //Add NestedSetsQueryTrait

    public static function find()
    {
        return new CategoryQuery(static::class);
    }



    public function getSeoTitle()
    {

        return $this->meta_title ? $this->meta_title : $this->getHeadingTile();


    }

    public function getHeadingTile()
    {
        return $this->title ? $this->title : $this->name;
    }


}