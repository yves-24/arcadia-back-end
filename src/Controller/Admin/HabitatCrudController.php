<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HabitatCrudController extends AbstractCrudController
{
    const UPLOAD_POST_BASE_PATH = 'images/habitat';
    const UPLOAD_POST_ROOT_PATH = 'public/images/habitat';

    public static function getEntityFqcn(): string
    {
        return Habitat::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            TextField::new('slug', 'Slug')->hideOnForm(),
            TextEditorField::new('description', 'Description'),
            TextareaField::new('comment', 'Commentaire'),
            TextField::new('imageFile', 'Image illustrative')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('image', 'Image de l\'habitat')
                ->hideOnForm()
                ->setBasePath(self::UPLOAD_POST_BASE_PATH)
                ->setUploadDir(self::UPLOAD_POST_ROOT_PATH)
                ->setSortable(false),
            AssociationField::new('animal', 'Animaux de l\'habitat'),
        ];
    }
}
