<?php


namespace App\Form\DataTransformer;


use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ItemToNameTransformer implements DataTransformerInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Item|null $item The value in the original representation
     *
     * @return mixed The value in the transformed representation
     *
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($item)
    {
        if (null === $item) {
            return '';
        }

        return $item->getName();
    }

    /**
     * @param int|null $itemName The value in the transformed representation
     *
     * @return mixed The value in the original representation
     *
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($itemName)
    {
        if (empty($itemName)) {
            throw new TransformationFailedException('Item cannot be empty');
        }

        $item = $this->entityManager
            ->getRepository(Item::class)
            ->findOneBy(['name' => $itemName]);

        if (null === $item) {
            $item = new Item();
            $item->setName($itemName);
        }

        return $item;
    }
}