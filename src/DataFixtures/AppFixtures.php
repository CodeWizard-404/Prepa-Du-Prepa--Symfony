<?php

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Creating courses for the first year
        $courses = [
            ['title' => 'Mathématiques et Physique (MP)', 'description' => 'Mathématiques avancées et physique.', 'level' => '1ère Année', 'subject' => 'Mathématiques, Physique'],
            ['title' => 'Physique et Technologie (PT)', 'description' => 'Physique et technologie.', 'level' => '1ère Année', 'subject' => 'Physique, Technologie'],
            ['title' => 'Sciences de l\'Ingénieur (SI)', 'description' => 'Mathématiques, physique et sciences de l\'ingénieur.', 'level' => '1ère Année', 'subject' => 'Mathématiques, Physique, Sciences de l\'Ingénieur'],
            ['title' => 'Biologie, Chimie et Géologie (BCG)', 'description' => 'Biologie, chimie et géologie.', 'level' => '1ère Année', 'subject' => 'Biologie, Chimie, Géologie'],
            ['title' => 'Économie et Gestion (EG)', 'description' => 'Économie, gestion et mathématiques.', 'level' => '1ère Année', 'subject' => 'Mathématiques, Économie, Gestion'],
            ['title' => 'Lettres et Sciences Sociales (LSS)', 'description' => 'Littérature et sciences sociales.', 'level' => '1ère Année', 'subject' => 'Littérature, Sciences Sociales'],
            ['title' => 'Lettres et Sciences Humaines (LSH)', 'description' => 'Littérature et sciences humaines.', 'level' => '1ère Année', 'subject' => 'Littérature, Sciences Humaines'],
            ['title' => 'Mathématiques, Informatique et Sciences de l\'Ingénieur (MPSI)', 'description' => 'Mathématiques, informatique et sciences de l\'ingénieur.', 'level' => '1ère Année', 'subject' => 'Mathématiques, Informatique, Sciences de l\'Ingénieur'],
            ['title' => 'Mathématiques, Physique et Sciences de l\'Ingénieur (MPSI)', 'description' => 'Mathématiques, physique et sciences de l\'ingénieur.', 'level' => '1ère Année', 'subject' => 'Mathématiques, Physique, Sciences de l\'Ingénieur'],
            ['title' => 'Physique, Chimie et Sciences de l\'Ingénieur (PCSI)', 'description' => 'Physique, chimie et sciences de l\'ingénieur.', 'level' => '1ère Année', 'subject' => 'Physique, Chimie, Sciences de l\'Ingénieur'],
            ['title' => 'Physique, Chimie et Technologie (PCT)', 'description' => 'Physique, chimie et technologie.', 'level' => '1ère Année', 'subject' => 'Physique, Chimie, Technologie'],
            ['title' => 'Biologie, Chimie, Physique et Sciences de la Terre (BCPST)', 'description' => 'Biologie, chimie, physique et sciences de la Terre.', 'level' => '1ère Année', 'subject' => 'Biologie, Chimie, Physique, Sciences de la Terre'],
            ['title' => 'Technologie et Sciences Industrielles (TSI)', 'description' => 'Technologie et sciences industrielles.', 'level' => '1ère Année', 'subject' => 'Technologie, Sciences Industrielles'],
            ['title' => 'Technologie, Sciences Industrielles et Développement Durable (TSIDD)', 'description' => 'Technologie, sciences industrielles et développement durable.', 'level' => '1ère Année', 'subject' => 'Technologie, Sciences Industrielles, Développement Durable'],
        ];

        // Adding courses to the database
        foreach ($courses as $courseData) {
            $course = new Course();
            $course->setTitle($courseData['title']);
            $course->setDescription($courseData['description']);
            $course->setLevel($courseData['level']);
            $course->setSubject($courseData['subject']);
            
            // Persisting the course
            $manager->persist($course);
        }

        // Flush to database
        $manager->flush();
    }
}
