<?php

namespace App\Controller\Admin;
use App\Entity\Ingredient;
use App\Form\Type\IngredientType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
       
            yield IdField::new('id')->hideOnForm();
            yield TextField::new('Nom');
            yield CollectionField::new('idImage')->setEntryType(IngredientType::class);
        
    }
    
}
