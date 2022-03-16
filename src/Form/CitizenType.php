<?php

namespace App\Form;

use App\Entity\Citizen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitizenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email');
        if ($options['mode'] === "edit")
            $builder
                ->add('password');
        $builder
            ->add('roles')
            ->add('mentored');
        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            function ($tagsAsArray) {
                return \implode(',', $tagsAsArray);
            },

            function ($tagsAsString) {
                return explode(', ', $tagsAsString);
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Citizen::class,
            'mode' => "standard"
        ]);
    }
}
