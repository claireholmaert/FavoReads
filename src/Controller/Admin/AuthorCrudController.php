<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Author::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('name');
        yield AssociationField::new('books')
            ->onlyOnIndex();
        yield ArrayField::new('books')
            ->onlyOnDetail();
    }

}
