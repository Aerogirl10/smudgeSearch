<?php

namespace App\Controller\Admin;

use App\Entity\Tool;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ToolCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tool::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $imageFile = Field::new('thumbnailFile')->setFormType(VichImageType::class);
        $image = ImageField::new('thumbnail')->setBasePath('/public/images/tools');
        $fields = [
            //            IdField::new('id'),
            TextField::new('model'),
            NumberField::new('year'),
            AssociationField::new('brand')->autocomplete(),
            AssociationField::new('createdBy')->hideOnForm(),
        ];

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }
        return $fields;
    }

}
