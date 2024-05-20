<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Content;
use App\Entity\Course;
use App\Form\ContentType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContentCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;
    private CourseRepository $courseRepository;

    public function __construct(EntityManagerInterface $entityManager, CourseRepository $courseRepository)
    {
        $this->entityManager = $entityManager;
        $this->courseRepository = $courseRepository;
    }

    #[Route(path: '/content', name: 'content')]
    public function route(): Response
    {
        return $this->render('support/index.html.twig');
    }

    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id')->hideOnForm(),
            AssociationField::new('course')
                ->setCrudController(CourseCrudController::class)
                ->setRequired(true),
            
            ChoiceField::new('subject')
                ->setChoices($this->getSubjectsFromCourses()),    
            
            ChoiceField::new('type')
                ->setChoices([
                    'Cours' => 'Cours',
                    'TP' => 'TP',
                    'TD' => 'TD',
                    'EXAM' => 'EXAM',
                ]),
            TextField::new('title'),
            TextEditorField::new('description'),

            Field::new('documentFile')
                ->setFormType(VichFileType::class)
                ->setLabel('Document')
                ->onlyOnForms(),
            TextField::new('documentPath')
                ->setLabel('Document Path')
                ->onlyOnIndex(),
        ];
    }

    private function getSubjectsFromCourses(): array
    {
        $courses = $this->courseRepository->findAll();
        $subjects = [];
        foreach ($courses as $course) {
            foreach ($course->getSubjects() as $subject) {
                $subjects[$subject] = $subject;
            }
        }
        return $subjects;
    }

    public function create(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentFile = $form->get('documentFile')->getData();
            if ($documentFile) {
                $content->setDocumentFile($documentFile);
            }

            $this->entityManager->persist($content);
            $this->entityManager->flush();

            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(50);
    }
}
