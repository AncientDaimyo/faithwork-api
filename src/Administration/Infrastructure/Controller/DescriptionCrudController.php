<?php

namespace App\Administration\Infrastructure\Controller;

use App\Product\Domain\Entity\Description;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Description::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('print'),
            TextField::new('density'),
            TextField::new('compound')
        ];
    }
}
