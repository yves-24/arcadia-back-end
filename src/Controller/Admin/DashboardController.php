<?php

namespace App\Controller\Admin;

use App\Entity\Advice;
use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\HealthState;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\VetReport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'arcadia_admin')]
    public function index(): Response
    {
//        return parent::index();
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fas fa-border-none');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class)
            ->setPermission('ROLE_BOSS');
        yield MenuItem::linkToCrud('Habitats', 'fas fa-tree', Habitat::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-paw', Animal::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-shopping-cart', Service::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-inbox', Advice::class);
        yield MenuItem::linkToCrud('état de santé', 'fas fa-file-medical-alt', HealthState::class)
            ->setCssClass('text-capitalize')
            ->setPermission('ROLE_VET');
        yield MenuItem::linkToCrud('Faire un rapport de santé', 'fas fa-notes-medical', VetReport::class)
            ->setCssClass('text-capitalize')
            ->setPermission('ROLE_VET');
        yield MenuItem::linkToUrl('Accueil', 'fa fa-home', $this->generateUrl('arcadia_home'));
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addCssFile('assets/css/dashboard.css');
    }
}
