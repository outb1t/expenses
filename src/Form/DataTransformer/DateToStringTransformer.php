<?php


namespace App\Form\DataTransformer;


use DateTime;
use Exception;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateToStringTransformer implements DataTransformerInterface
{

    /**
     * @param DateTime|null $value The value in the original representation
     *
     * @return string The value in the transformed representation
     *
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
        return $value->format('d.m.Y');
    }

    /**
     * @param mixed $value The value in the transformed representation
     *
     * @return mixed The value in the original representation
     *
     * @throws Exception
     */
    public function reverseTransform($value): DateTime
    {
        return new DateTime($value);
    }
}