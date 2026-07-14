<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MyController extends AbstractController
{	
	#[Route('/e01', name: 'homepage')]
	public function index()
	{
		return $this->render('home.html.twig');
	}

    #[Route('/e01/{article}', name: 'article_show')]
    public function article(string $article)
    {
		$articles = $this->getParameter('categories');
		foreach ($articles as $item)
		{
			if ($item === $article)
				return $this->render($article . '.html.twig');
		}
        return $this->redirectToRoute('homepage');
    }
}
