<?php
namespace App\Form;
use App\Entity\Hotel;
use App\Entity\Service;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('hotel', EntityType::class, array(
                'class' => Hotel::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false
            ))
            ->add('price', NumberType::class, array(
                'label' => 'Kaina',
                'attr' => array('placeholder' => '')
            ))
            ->add('name', TextType::class, array(
                'label' => 'Paslaugos pavadinimas',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti kambarį'
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Service::class,
        ));
    }
}