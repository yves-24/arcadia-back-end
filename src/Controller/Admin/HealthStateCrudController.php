<?php

namespace App\Controller\Admin;

use App\Entity\HealthState;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HealthStateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HealthState::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('state', 'état de santé')->setCssClass('text-capitalize'),
        ];
    }
}
