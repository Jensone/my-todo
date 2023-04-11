<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(TodoRepository $todos): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'todos' => $todos,
            'todos' => $todos->findAll(),
        ]);
    }

    /**
     * Redirection form '/' to '/home' protected route (view)
     * @Route("/", name="app_index")
     */
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    /**
     * Delete a todo
     * @Route("/delete/{id}", name="delete")
     */
     
     #[Route('/delete/{id}', name: 'delete')]
    public function delete($id, TodoRepository $todos): Response
    {
        $todo = $todos->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($todo);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }

    /**
     * Valid a todo (change status 0 to 1 boolean)
     * @Route("/valid/{id}", name="valid")
     */

    #[Route('/valid/{id}', name: 'valid')]
    public function valid($id, TodoRepository $todos): Response
    {
        $todo = $todos->find($id);
        $todo->setCompletion(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($todo);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }
}
