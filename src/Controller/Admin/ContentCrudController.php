<?php

namespace App\Controller\Admin;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Content;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use App\Form\CustomFileType;
use Symfony\Component\HttpFoundation\Request;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            ChoiceField::new('type')
                ->setChoices([
                    'Cours'=>'Cours',
                    'TP' => 'TP',
                    'TD' => 'TD',
                    'EXAM' => 'EXAM',
                ]),
            TextField::new('title'),
            TextEditorField::new('description'),
            Field::new('document')
                ->setFormType(CustomFileType::class)
                ->setLabel('Document'),
            AssociationField::new('course')
                ->setCrudController(CourseCrudController::class)
                ->setRequired(true),
        ];
    }
    public function create(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(CustomFileType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $content->setDocument($form->get('documentFile')->getData());

            $entityManager = $this->$this->getDoctrine();
            $entityManager()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();

            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }
}
