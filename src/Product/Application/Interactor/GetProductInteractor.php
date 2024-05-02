<?php

namespace App\Product\Application\Interactor;

use App\Product\Application\Boundary\ProductRepositoryInterface;

class GetProductInteractor
{
    public static function getProductsArray($repository): array
    {
        $products = ProductRepositoryInterface::getProductsFromRepository($repository);
        $productsDtoArray = [];
        foreach ($products as $p) {
            $arr_i = array(
                'uuid'          => $p->getId(),
                'name'          => $p->getName(),
                'cost'          => $p->getCost(),
                'article'       => $p->getArticle(),
                'image'         => $p->getImage(),
                'description'   => $p->getDescriptionArr(),
                'sizes'         => $p->getSizesArr()

            );
            array_push($productsDtoArray, $arr_i);
        }
        return $productsDtoArray;
    }

    public static function getProductByUuid($repository, $uuid): array
    {
        $p = ProductRepositoryInterface::getProductFromRepositoryByUuid($repository, $uuid);

        // $file = '%kernel.project_dir%/images/main/'. $p->getImage();
        // $path = pathinfo($file);
        // $ext = mb_strtolower($path['extension']);
        // $img = "";
        // if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'))) {
        //     if ($ext == 'svg') {
        //         $img = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($file));
        //     } else {
        //         $size = getimagesize($file);
        //         $img = 'data:' . $size['mime'] . ';base64,' . base64_encode(file_get_contents($file));
        //     }
        // }
        $product_dto = array(
            'uuid'          => $p->getId(),
            'name'          => $p->getName(),
            'cost'          => $p->getCost(),
            'article'       => $p->getArticle(),
            // 'image'         => $img,
            'description'   => $p->getDescriptionArr(),
            'sizes'         => $p->getSizesArr()

        );


        return $product_dto;
    }
}
