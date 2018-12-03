<?php
namespace App\Form;
use App\Entity\Hotel;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Viešbučio pavadinimas',
                'attr' => array('placeholder' => '')
            ))
            ->add('companyCode', TextType::class, array(
                'label' => 'Įmonės kodas',
                'attr' => array('placeholder' => '')
            ))
            ->add('rating', NumberType::class, array(
                'label' => 'Reitingas',
                'attr' => array('placeholder' => '')
            ))
            ->add('address', TextType::class, array(
                'label' => 'Adresas',
                'attr' => array('placeholder' => '')
            ))
            ->add('website', UrlType::class, array(
                'label' => 'Tinklapis',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti viešbutį'
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Hotel::class,
        ));
    }
}