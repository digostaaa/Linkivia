<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class TicketCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Ticket::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('subject'),
            TextEditorField::new('content'),
            TextField::new('category'),
            ChoiceField::new('status')->setChoices( ['Pending' => 'Pending', 'Resolved' => 'Resolved', 'Declined' => 'Declined' ] )
        ];
    }
    
}
