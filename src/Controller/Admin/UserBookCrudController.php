<?php

namespace App\Controller\Admin;

use App\Entity\UserBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserBookCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return UserBook::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('reader');
        yield TextField::new('book');
        yield TextareaField::new('comment');
        yield Field::new('rating');
        yield AssociationField::new('status', 'Statut')
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
