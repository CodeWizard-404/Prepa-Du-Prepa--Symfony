<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository, CourseRepository $courseRepository): Response
    {
        $professors = $userRepository->findProfessors();
        $courses = $courseRepository->findAll();

        return $this->render('home/index.html.twig', [
            'professors' => $professors,
            'courses'=> $courses,  
        ]);
    }

     

}
