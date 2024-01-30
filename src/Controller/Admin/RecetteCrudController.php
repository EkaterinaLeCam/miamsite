<?php

namespace App\Controller\Admin;
use App\Entity\Image;
use App\Entity\Recette;
use App\Form\Type\IdRecetteIngredientType;
use App\Form\Type\PhotoRecetteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            CollectionField::new('photoRecette')->setEntryType(PhotoRecetteType::class),
            CollectionField::new('idRecetteIngredient')->setEntryType(IdRecetteIngredientType::class),
            AssociationField::new('idSousCategorie'),
            TextField::new('tempDeCuisson'),
            TextField::new('calorie'),
            TextareaField::new('preparation')->renderAsHtml(),
            
            

        ];
    }
    
}
