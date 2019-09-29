<?php


namespace App\Controller\Rest;


use App\Entity\Expense;
use App\Form\ExpenseType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Prefix;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ExpensesController
 * @Prefix("/api")
 * @Rest\NamePrefix("api_")
 */
class ExpensesController extends AbstractFOSRestController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getExpensesAction()
    {
        $expenses = $this->em->getRepository(Expense::class)->findAll();
        return $expenses;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postExpenseAction(Request $request)
    {
        $expense = new Expense();
        $form = $this->createForm(ExpenseType::class, $expense);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expense);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }

}
