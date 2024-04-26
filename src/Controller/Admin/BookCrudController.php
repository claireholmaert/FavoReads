<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('title');
        yield TextField::new('subtitle');
        yield TextField::new('description');
        yield TextField::new('isbn10');
        yield TextField::new('isbn13');
        yield ImageField::new('smallThumbnail');
        yield ImageField::new('thumbnail');
        yield CollectionField::new('authors');
        yield CollectionField::new('publishers');
        yield TextField::new('googleBooksId');
    }
}
