<?php


namespace App\Tests\Form\DataTransformer;


use App\Form\DataTransformer\DateToStringTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateToStringTransformerTest extends TestCase
{

    public function testTransformReturnsValidDateFormat()
    {
        $dateToStringTransformer = new DateToStringTransformer();
        $date = $dateToStringTransformer->transform(new DateTime('21.07.2019 15:33:01'));
        $this->assertEquals('21.07.2019', $date);
    }

    public function testReverseTransformReturnsValidDateObject()
    {
        $dateToStringTransformer = new DateToStringTransformer();
        $date = $dateToStringTransformer->reverseTransform('21.07.2019');
        $this->assertEquals(new DateTime('21.07.2019'), $date);
    }

}