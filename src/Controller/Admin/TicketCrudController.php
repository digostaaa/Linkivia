<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class TicketCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Ticket::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('subject'),
            TextEditorField::new('content'),
            TextField::new('category'),
            ChoiceField::new('status')->setChoices( ['pending' => 'pending', 'Resolved' => 'Resolved', 'Declined' => 'Declined' ] )
        ];
    }
    
}
