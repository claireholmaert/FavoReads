<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\UserBook;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(BookCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FavoReads');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Books', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Author', 'fas fa-user-pen', Author::class);
        yield MenuItem::linkToCrud('Publisher', 'fas fa-building', Publisher::class);
        yield MenuItem::linkToCrud('Status', 'fas fa-info-circle', Status::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('UserBook', 'fas fa-book-reader', UserBook::class);
    }
}
