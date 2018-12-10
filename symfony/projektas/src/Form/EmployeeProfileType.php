<?php
namespace App\Form;
use App\Entity\User;
use App\Entity\Employee;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class EmployeeProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Darbuotojo vardas',
                'attr' => array('placeholder' => '')
            ))
            ->add('surname', TextType::class, array(
                'label' => 'Darbuotojo pavardė',
                'attr' => array('placeholder' => '')
            ))
            ->add('personalCode', TextType::class, array(
                'label' => 'Asmens kodas',
                'attr' => array('placeholder' => '')
            ))
            ->add('employeeType', ChoiceType::class, array(
                'choices' => array(
                    'Sandelio darbuotojas' => '2',
                    'Administratorius' => '3',
                    'Kambarine' => '4'),
                'label' => 'Darbuotojo tipas'
            ))
            ->add('salary', IntegerType::class, array(
                'label' => 'Alga',
                'attr' => array('placeholder' => '')
            ))
            ->add('bankAccount', TextType::class, array(
                'label' => 'Banko sąskaita',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti darbuotoją'
                //'attr' => array('id' => 'carTypeSubmit')
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Employee::class,
        ));
    }
}