<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository, CourseRepository $courseRepository, Request $request, ContentRepository $contentRepository): Response
    {
        $professors = $userRepository->findProfessors();
        $courses = $courseRepository->findAll();

        $query = $request->query->get('q');
        $results = [];

        if ($query) {
            $results = $contentRepository->findCoursesByTitle($query);
        }

        return $this->render('home/index.html.twig', [
            'professors' => $professors,
            'courses' => $courses,  
            'results' => $results,
        ]);
    }


}

