<?php
namespace App\Form;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\Service;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('room', EntityType::class, array(
                'label' => 'Kambario kaina',
                'class' => Room::class,
                'choice_label' => 'kaina',
                'expanded' => false,
                'multiple' => false
            ))
            ->add('start', DateType::class, array(
                'label' => 'Start date'
            ))
            ->add('end', DateType::class, array(
                'label' => 'End date'
            ))
            ->add('services', EntityType::class, array(
                'label' => 'Papildomos paslaugos',
                'class' => Service::class,
                'choice_label' =>  function ($service) {
                    return $service->getName() . '(' . $service->getPrice() .')';
                },
                'expanded' => true,
                'multiple' => true
            ))
            ->add('discountCode', TextType::class, array(
                'mapped' => false
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti rezervaciją'
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Reservation::class,
        ));
    }
}