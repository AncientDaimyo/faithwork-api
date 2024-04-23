<?php

namespace App\Administration\Infrastructure\Controller;

use App\Product\Domain\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
            MoneyField::new('cost')->setCurrency('RUB')->setNumDecimals(2)->setStoredAsCents(false),
            ImageField::new('image')->setUploadDir(realpath('public/images/products')),
            ImageField::new('image_tablet')->setUploadDir(realpath('public/images/products/tablet')),
            ImageField::new('image_mobile')->setUploadDir(realpath('public/images/products/mobile')),
            AssociationField::new('sizes')->setFormTypeOption('attr',['required' => 'required'])->setRequired(true),
            AssociationField::new('description')->setCrudController(DescriptionCrudController::class)->renderAsEmbeddedForm(DescriptionCrudController::class)->setFormTypeOption('attr',['required' => 'required'])->setRequired(true)
        ];
    }
    
} 
