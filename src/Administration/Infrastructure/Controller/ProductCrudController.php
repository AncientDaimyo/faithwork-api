<?php

namespace App\Administration\Infrastructure\Controller;

use App\Product\Domain\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('article'),
            MoneyField::new('cost')->setCurrency('RUB')->setNumDecimals(2)->setStoredAsCents(false),
            ImageField::new('image')->setBasePath('public/uploads/images')->setUploadDir('images/main'),
            ImageField::new('image_tablet')->setBasePath('public/uploads/images')->setUploadDir('images/tablet'),
            ImageField::new('image_mobile')->setBasePath('public/uploads/images')->setUploadDir('images/mobile'),
            AssociationField::new('sizes')->setFormTypeOption('attr',['required' => 'required'])->setRequired(true),
            AssociationField::new('description')->setCrudController(DescriptionCrudController::class)->renderAsEmbeddedForm(DescriptionCrudController::class)->setFormTypeOption('attr',['required' => 'required'])->setRequired(true)
        ];
    }
    
} 
