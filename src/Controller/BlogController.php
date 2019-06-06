<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Mathieu',
        ]);
    }

    /**
     * @Route("/blog/show/{slug<^[a-z0-9-]+$>?}", name="blog_show",defaults={"slug"="Article sans titre"})
     */

    public function show(?string $slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        return $this->render(
            'blog/show.html.twig',
            [
                'slug' => $slug,
            ]
        );
    }
}