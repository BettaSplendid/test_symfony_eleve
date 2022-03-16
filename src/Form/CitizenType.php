<?php

namespace App\Form;

use App\Entity\Citizen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitizenType extends AbstractType
{
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('lastname')
                ->add('firstname')
                ->add('email');
            if ($options['mode'] !== "edit")
                $builder
                    ->add('password');
            $builder
                ->add('mentored');
            $builder
                ->add('roles', TextType::class);
            $builder->get('roles' , TextType::class)
                ->addModelTransformer(new CallbackTransformer(
                    function ($tagsAsArray) {
                        // transform the array to a string
                        return implode(', ', $tagsAsArray);
                    },
                    function ($tagsAsString) {
                        // transform the string back to an array
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
