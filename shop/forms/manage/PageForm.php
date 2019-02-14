<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 14.02.19
 * Time: 11:54
 */

namespace shop\forms\manage;


use shop\entities\Page;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class PageForm extends Model
{



    public $title;
    public $content;
    public $parentId;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    private $_page;


    public function __construct(Page $page = null, array $config = [])
    {
        if ($page) {

            $this->title = $page->title;
            $this->content = $page->content;
            $this->parentId = $page->parent ? $page->parent->id : null;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->meta_keywords = $page->meta_keywords;

            $this->_page = $page;
        }

        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['title', 'meta_title', 'meta_description', 'meta_keywords'], 'required'],
            [['parentId'], 'integer'],
            [[ 'title', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['title'], 'unique', 'targetClass' => Page::class,
                'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null]


        ];


    }

    /**
     * @return array
     */
    public function parentCategoriesList()
    {
        return ArrayHelper::map(Page::find()->orderBy('lft')->asArray()->andWhere($this->_page ? ['<>', 'id', $this->_page->id] : null)->all(), 'id', function (array $page) {


            return ($page['depth'] > 1 ? str_repeat('-- ', $page['depth'] - 1) . ' ' : '') . $page['title'];}

        );
    }











}