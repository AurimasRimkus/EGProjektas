<?php
namespace App\Form;
use App\Entity\Item;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Daikto pavadinimas',
                'attr' => array('placeholder' => '')
            ))
            ->add('amount', TextType::class, array(
                'label' => 'Likutis',
                'attr' => array('placeholder' => '')
            ))
            ->add('expirationDate', DateType::class, array(
                'label' => 'Galiojimo data',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti daiktą'
                //'attr' => array('id' => 'carTypeSubmit')
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Item::class,
        ));
    }
}