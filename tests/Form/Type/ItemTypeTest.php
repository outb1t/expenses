<?php


namespace App\Tests\Form\Type;


use App\Entity\Item;
use App\Form\ItemType;
use Symfony\Component\Form\Test\TypeTestCase;

class ItemTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $data = ['name' => 'testName'];
        $item = new Item();
        $form = $this->factory->create(ItemType::class, $item);

        $itemToCompare = new Item();
        $itemToCompare->setName($data['name']);

        $form->submit($data);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($item, $itemToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }

    }

}