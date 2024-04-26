<?php

namespace App\Controller\Admin;

use App\Entity\Status;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatusCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Status::class;
    }
}
