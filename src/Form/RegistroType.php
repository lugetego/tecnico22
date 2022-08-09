<?php

namespace App\Form;

use App\Entity\Registro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',null, array(
                'label'=>'Nombre(s)',
            ))
            ->add('paterno', null, array(
                'label'=>'Apellido paterno',
            ))
            ->add('materno', null, array(
                'label'=>'Apellido materno',
            ))
            ->add('direccion', null, array(
                'label'=>'Dirección',
            ))
            ->add('email', null, array(
                'label'=>'Correo electrónico',
            ))
            //->add('activo')
        /*    ->add('unidad', ChoiceType::class, [
                'label'=>'Unidades de apoyo del CCM',
                'placeholder' => 'Seleccionar',
                'choices'  => [
                    'Técnico Académico en la Unidad de Cómputo' => 'Cómputo' ,
                    'Técnico Académico en la Unidad de Documentación' => 'Documentación',

                ],
            ])*/
            ->add('solicitudFile', VichFileType::class, [
                'required' => true,
                'label'=>'Carta solicitud'
            ])
            ->add('cvFile', VichFileType::class, [
                'required' => true,
                'label'=>'Currículum Vitae'

            ])
            ->add('comprobanteFile', VichFileType::class, [
                'required' => true,
                'label'=>'Comprobante oficial de grado'

            ])
            ->add('cursoFile', VichFileType::class, [
                'required' => true,
                'label'=>'Comprobantes'

            ])
            ->add('ref1recomFile', VichFileType::class, [
                'required' => true,
                'label'=>'Carta de recomendación 1'
            ])
            ->add('ref2recomFile', VichFileType::class, [
                'required' => true,
                'label'=>'Carta de recomendación 2'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registro::class,
        ]);
    }
}
