<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield TextField::new('Nom'),
            yield AssociationField::new('idImage')->setCrudController(IngredientCrudController::class)
        ];
    }
    
}
