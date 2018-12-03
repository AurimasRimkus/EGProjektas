<?php
namespace App\Form;
use App\Entity\User;
use App\Entity\Employee;
use App\Entity\DayReport;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class DayReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayLength', IntegerType::class, array(
                'label' => 'Darbo trukmė',
                'attr' => array('placeholder' => '')
            ))
            ->add('comment', TextType::class, array(
                'label' => 'Komentaras',
                'attr' => array('placeholder' => '')
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Saugoti dienos ataskaitą'
                //'attr' => array('id' => 'carTypeSubmit')
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DayReport::class,
        ));
    }
}