<?php

namespace App\Controller\Admin;

use App\Entity\UserBook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
        yield TextField::new('status');
    }
}
