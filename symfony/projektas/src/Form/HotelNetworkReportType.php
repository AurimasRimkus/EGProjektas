<?php
namespace App\Form;
use App\Entity\User;
use App\Entity\Employee;
use App\Entity\HotelNetworkReport;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class HotelNetworkReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hotel', TextType::class, array(
                'label' => 'Viešbutis',
                'attr' => array('placeholder' => '')
            ))
            ->add('price', MoneyType::class, array(
                'label' => 'Viešbučio pelnas ',
                'attr' => array('placeholder' => '')
            ))
            ->add('comment', TextType::class, array(
                'label' => 'Komentaras',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti ataskaitą'
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => HotelNetworkReport::class,
        ));
    }
}