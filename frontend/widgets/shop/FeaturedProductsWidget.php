<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 26.05.18
 * Time: 21:43
 */
namespace frontend\widgets\shop;



use shop\readModels\shop\ProductReadRepository;
use yii\base\Widget;

class FeaturedProductsWidget extends Widget
{

    public $limit;

    private $repository;

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;

    }


    public function run()
    {
        return $this->render('featured',[

            'products' => $this->repository->getFeatured($this->limit)
        ]);



    }

}