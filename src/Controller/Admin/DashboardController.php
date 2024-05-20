<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Course;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Fetch counts
        $userRepository = $this->entityManager->getRepository(User::class);
        $courseRepository = $this->entityManager->getRepository(Course::class);
        $contentRepository = $this->entityManager->getRepository(Content::class);

        $usersCount = $userRepository->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $coursesCount = $courseRepository->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $contentCount = $contentRepository->createQueryBuilder('ct')
            ->select('COUNT(ct.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $pendingRequestsCount = 10;
        $latestUsers = ['User 1', 'User 2', 'User 3'];
        $popularCourses = ['Course A', 'Course B', 'Course C'];
    
        $courseEnrollment = [
            'Course X' => 50,
            'Course Y' => 100,
            'Course Z' => 150,
        ];

        $adminCount = $userRepository->countByRole('admin');
        $professorCount = $userRepository->countByRole('professeur');
        $studentCount = $userRepository->countByRole('etudiant');

        // Render the dashboard with data
        return $this->render('dashboard.html.twig', [
            'adminCount' => $adminCount,
            'professorCount' => $professorCount,
            'studentCount' => $studentCount,
            'usersCount' => $usersCount,
            'coursesCount' => $coursesCount,
            'contentCount' => $contentCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'latestUsers' => $latestUsers,
            'popularCourses' => $popularCourses,
            'courseEnrollment' => $courseEnrollment,
        ]);
    }

    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Prepa Du Prepa');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class)
            ->setDefaultSort(['id' => 'DESC']);

        yield MenuItem::linkToCrud('Course', 'fas fa-book-open', Course::class)
            ->setDefaultSort(['id' => 'DESC']);

        yield MenuItem::linkToCrud('Content', 'fas fa-file-alt', Content::class)
            ->setDefaultSort(['id' => 'DESC']);
    }
}



