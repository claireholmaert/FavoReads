<?php

namespace App\Controller\Admin;

use App\Entity\Status;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Status::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('name')
            ->formatValue(function ($value) {
                // Définir la couleur du badge en fonction du statut
                $badgeColor = '';
                switch ($value) {
                    case 'read':
                        $badgeColor = 'badge-primary';
                        break;
                    case 'reading':
                        $badgeColor = 'badge-success';
                        break;
                    case 'to-read':
                        $badgeColor = 'badge-warning';
                        break;
                    // Ajoutez d'autres cas pour chaque statut avec sa couleur correspondante
                    default:
                        $badgeColor = 'badge-secondary'; // Couleur par défaut
                        break;
                }

                // Retourner le badge coloré
                return sprintf('<span class="badge %s">%s</span>', $badgeColor, $value);
            });
    }
}
