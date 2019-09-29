<?php


namespace App\Form\DataTransformer;


use DateTime;
use Exception;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TimeToStringTransformer implements DataTransformerInterface
{


    /**
     * @param mixed $value The value in the original representation
     *
     * @return mixed The value in the transformed representation
     *
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
        return $value->format('H:i');
    }

    /**
     * @param mixed $value The value in the transformed representation
     *
     * @return mixed The value in the original representation
     *
     * @throws Exception
     */
    public function reverseTransform($value)
    {
        $time = date_parse($value);
        if ($time['hour'] !== false) {
            $dateTime = new DateTime();
            if ($time['minute'] !== false) {
                $dateTime->setTime($time['hour'], $time['minute']);
            } else {
                $dateTime->setTime($time['hour'], 0);
            }
            return $dateTime;
        }
        return null;
    }
}