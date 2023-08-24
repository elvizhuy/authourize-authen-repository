<?php
namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\BaseRepository;
use \App\Repositories\Products\ProductRepositoryInterface;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function getProducts()
    {
        return $this->model->getAll();
    }
}

