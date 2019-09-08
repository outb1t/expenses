<?php


namespace App\Controller;


use App\Entity\Expense;
use App\Entity\Item;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @return Response
     */
    public function test()
    {
        return new Response("<body></body>");
    }

    /**
     * @Rest\Route(
     *     path="form",
     *     name="addExpenseFormHandler",
     *     methods={"POST"}
     * )
     */
    public function addExpenseFormHandler(Request $request, EntityManagerInterface $em)
    {
        $post = $request->request;
        $expenseName = $post->get('expenseName');
        $item = $em->getRepository(Item::class)->findOneBy(['name' => $expenseName]);
        if (null === $item) {
            $item = new Item();
            $item->setName($expenseName);
        }
        $expense = new Expense();
        $expense->setCount((int)$post->get('count'));
        $expense->setAmount((int)$post->get('amount'));
        $dateTime = new DateTime($post->get('date'));
        $expense->setDate($dateTime);
        $expense->setItem($item);
        $time = date_parse($post->get('time'));
        if ($time['hour'] !== false && $time['minute'] !== false) {
            $dateTime->setTime($time['hour'], $time['minute']);
            $expense->setTime($dateTime);
        }
        $em->persist($expense);
        $em->flush();

        return $this->json($post->all());
    }

}