<?php

namespace App\Form;

use App\Entity\Citizen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Please enter a password',
                //     ]),
                //     new Length([
                //         'min' => 6,
                //         'minMessage' => 'Your password should be at least {{ limit }} characters',
                //         // max length allowed by Symfony for security reasons
                //         'max' => 4096,
                //     ]),
                // ],
            ])
            ->add('roles', ChoiceType::class, [
                "choices" => [
                    "Citizen" => "Citizen",
                    "Boss" => "Boss",
                ]
                ]);

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

            $builder->add('pupils', EntityType::class, [
                "class" => Citizen::class,
                "choices" => $options["mentor"] ?? "",
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                // 'constraints' => [
                //     new IsTrue([
                //         'message' => 'You should agree to our terms.',
                //     ]),
                // ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Citizen::class,
            'mentor' => [],
            // 'constraints' => [],
        ]);
    }
}
