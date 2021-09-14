<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    // public function configureFields(string $pageName): iterable
    // {
        
    //     return [
    //         IdField::new('id'),
    //         Field::new('username'),
    //         Password::new('password', password_hash()),
    //     ];
    // }
    
}
