<?php

namespace App\Controller\Admin;

use App\Entity\Publisher;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PublisherCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Publisher::class;
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
