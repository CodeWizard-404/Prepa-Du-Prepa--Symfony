<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
public function index(): Response
{
    $professors = [
        [
            'name' => 'Professor 1',
            'department' => 'Computer Science',
            'office' => 'Room 101',
        ],
        [
            'name' => 'Professor 2',
            'department' => 'Mathematics',
            'office' => 'Room 202',
        ],
    ];

    $courses = [
        [
            'name' => 'IT',
            'department' => 'Computer Science',
        ],
        [
            'name' => 'IT',
            'department' => 'Computer Science',
        ],
    ];

    return $this->render('home/index.html.twig', [
        'professors' => $professors,
        'courses'=> $courses,
    ]);
}

     

}
