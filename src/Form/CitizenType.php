<?php

namespace App\Form;

use App\Entity\Citizen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CitizenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                "choices" => [
                    "Citizen" => "Citizen",
                    "Boss" => "Boss",
                ]
            ])
            ->add('pupils', EntityType::class, [
                "class" => Citizen::class,
                "choices" => $options["mentor"] ?? "",
            ]);

        if ($options["mode"] !== "edit") {
            $builder->add('password');
        }
            // ->add('lesson')
        ;

        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            
            function ($tagsAsArray) {
                 // transform the array to a string
                 return implode(', ', $tagsAsArray);
            },
            function ($tagsAsString) {
                 // transform the string back to an array
                 return explode('. ', $tagsAsString);
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Citizen::class,
            'mentor' => [],
            'mode' => "",
        ]);
    }
}
