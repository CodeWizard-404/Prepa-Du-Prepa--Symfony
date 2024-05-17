<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        // Get the currently logged-in user
        $user = $this->getUser();
        
        // Fetch user's enrolled courses (assuming you have a relationship set up)
       // $enrolledCourses = $user->getEnrolledCourses();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            //'enrolledCourses' => $enrolledCourses,
        ]);
    }
}
