<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex as PasswordRegex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),

            EmailField::new('email')
                ->setRequired(true)
                ->setLabel('Email')
                ->setFormTypeOption('constraints', [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Email([
                        'message' => 'Please enter a valid email address',
                    ]),
                ]),

            TextField::new('username')
                ->setRequired(true)
                ->setLabel('Username'),
            
            TextField::new('password')
            ->setLabel('Password')
            ->setFormType(PasswordType::class)
            ->setFormTypeOptions([
                'mapped' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password must be at least {{ limit }} characters long',
                    ]),
                    new PasswordRegex([
                        'pattern' => '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/',
                        'message' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                    ]),
                ],
            ]),
            
            TextField::new('telephone')
                ->setLabel('Tel°')
                ->setRequired(false)
                ->setFormTypeOption('constraints', [
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Please enter a valid phone number',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Please enter a valid phone number',
                    ]),
                ]),
            
            ChoiceField::new('role')
                ->setChoices([
                    'Etudiant' => 'etudiant',
                    'Professeur' => 'professeur',
                    'Admin' => 'admin',
                ])
                ->setRequired(true)
                ->setLabel('Role')
                ->setFormTypeOption('constraints', [
                    new NotBlank([
                        'message' => 'Please select a role',
                    ]),
                ]),
            
            

        ];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    
}
