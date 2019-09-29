<?php


namespace App\Tests\Form\Type;


use App\Entity\Expense;
use App\Entity\Item;
use App\Form\DataTransformer\DateToStringTransformer;
use App\Form\DataTransformer\ItemToNameTransformer;
use App\Form\DataTransformer\TimeToStringTransformer;
use App\Form\ExpenseType;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ExpenseTypeTest extends TypeTestCase
{

    /**
     * @var MockObject
     */
    private $itemToNameTransformer;
    /**
     * @var MockObject
     */
    private $dateToeStringTransformer;
    /**
     * @var MockObject
     */
    private $timeToStringTransformer;
    private $date = '21.05.1990';

    public function testSubmitValidData()
    {
        $formData = [
            'count' => 1,
            'amount' => 1.05,
            'date' => null,
            'time' => null,
            'item' => null
        ];

        $objectToCompare = new Expense();
        $form = $this->factory->create(ExpenseType::class, $objectToCompare);

        $object = new Expense();
        $object
            ->setCount($formData['count'])
            ->setAmount($formData['amount'])
            ->setItem(new Item())
            ->setTime((new DateTime())->setTime(12, 37, 0))
            ->setDate(new DateTime($this->date));

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    protected function setUp()
    {
        $dateToStringTransformerMock = $this->createMock(DateToStringTransformer::class);
        $dateToStringTransformerMock
            ->method('reverseTransform')
            ->willReturn(new DateTime($this->date));
        $this->dateToeStringTransformer = $dateToStringTransformerMock;

        $itemToNameTransformerMock = $this->createMock(ItemToNameTransformer::class);
        $itemToNameTransformerMock
            ->method('reverseTransform')
            ->willReturn(new Item());
        $this->itemToNameTransformer = $itemToNameTransformerMock;

        $timeToStringTransformerMock = $this->createMock(TimeToStringTransformer::class);
        $timeToStringTransformerMock
            ->method('reverseTransform')
            ->willReturn((new DateTime())->setTime(12, 37, 0));
        $this->timeToStringTransformer = $timeToStringTransformerMock;

        parent::setUp();
    }

    protected function getExtensions()
    {
        $expenseType = new ExpenseType($this->itemToNameTransformer, $this->dateToeStringTransformer, $this->timeToStringTransformer);
        return [
            new PreloadedExtension([$expenseType], []),
        ];
    }

}