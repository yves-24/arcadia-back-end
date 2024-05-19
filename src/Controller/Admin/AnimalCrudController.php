<?php

namespace App\Controller\Admin;

use App\Document\ViewCount;
use App\Entity\Animal;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnimalCrudController extends AbstractCrudController
{
    const UPLOAD_POST_BASE_PATH = 'images/animal';
    const UPLOAD_POST_ROOT_PATH = 'public/images/animal';
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('slug', 'Slug')->hideOnForm(),
            TextField::new('race', 'Race'),
            TextField::new('imageFile', 'Image illustrative')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('image', 'Image de l\'animal')
                ->hideOnForm()
                ->setBasePath(self::UPLOAD_POST_BASE_PATH)
                ->setUploadDir(self::UPLOAD_POST_ROOT_PATH)
                ->setSortable(false),
            AssociationField::new('habitat', 'Affecter dans un habitat'),
        ];
    }
}
