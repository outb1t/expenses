<?php


namespace App\Form;


use App\Entity\Expense;
use App\Form\DataTransformer\DateToStringTransformer;
use App\Form\DataTransformer\ItemToNameTransformer;
use App\Form\DataTransformer\TimeToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseType extends AbstractType
{

    /**
     * @var ItemToNameTransformer
     */
    private $itemToNameTransformer;
    /**
     * @var DateToStringTransformer
     */
    private $dateToStringTransformer;
    /**
     * @var TimeToStringTransformer
     */
    private $timeToStringTransformer;

    public function __construct(
        ItemToNameTransformer $itemToNameTransformer,
        DateToStringTransformer $dateToStringTransformer,
        TimeToStringTransformer $timeToStringTransformer
    )
    {
        $this->itemToNameTransformer = $itemToNameTransformer;
        $this->dateToStringTransformer = $dateToStringTransformer;
        $this->timeToStringTransformer = $timeToStringTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('count')
            ->add('amount')
            ->add('date', TextType::class)
            ->add('time', TextType::class)
            ->add('item', TextType::class);
        $builder->get('item')
            ->addModelTransformer($this->itemToNameTransformer);
        $builder->get('date')
            ->addModelTransformer($this->dateToStringTransformer);
        $builder->get('time')
            ->addModelTransformer($this->timeToStringTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
            'csrf_protection' => false
        ]);
    }
}