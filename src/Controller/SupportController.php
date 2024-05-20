<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupportController extends AbstractController
{
    #[Route('/support', name: 'app_support')]
    public function index(CourseRepository $courseRepository, ContentRepository $contentRepository): Response
    {
        $courses = $courseRepository->findAll();
        $TDs = $contentRepository->findByType('TD');
        $TPs = $contentRepository->findByType('TP');
        $EXAMs = $contentRepository->findByType('EXAM');

        return $this->render('support/index.html.twig', [
            'courses'=> $courses,  
            'TPs'=> $TPs,  
            'TDs'=> $TDs,  
            'EXAMs'=> $EXAMs,  
        ]);
    }
}
