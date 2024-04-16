<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use App\Controller\Admin\Field\ImageDecoderField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('article'),
            TextareaField::new('description'),
            MoneyField::new('cost')->setCurrency('RUB')->setNumDecimals(2),
            ImageField::new('image')->setUploadDir(realpath('public/images/products')),
            ImageField::new('image_tablet')->setUploadDir(realpath('public/images/products/tablet')),
            ImageField::new('image_mobile')->setUploadDir(realpath('public/images/products/mobile'))
        ];
    }
    
} 
