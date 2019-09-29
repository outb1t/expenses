<?php


namespace App\Controller;


use App\Entity\Expense;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route(path="/", name="home")
     * @return Response
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route(path="/test", name="test")
     */
    public function test(EntityManagerInterface $em)
    {
        $expenses = $em->getRepository(Expense::class)->findAll();
        return $expenses;
    }

}