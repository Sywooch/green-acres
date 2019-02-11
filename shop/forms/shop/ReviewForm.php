<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 24.01.19
 * Time: 23:08
 */

namespace shop\forms\shop;


use yii\base\Model;

class ReviewForm extends Model
{

    public $vote;
    public $text;

    public function rules()
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => array_keys($this->votesList())],
            ['text', 'string'],
        ];
    }

    public function votesList()
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }








}