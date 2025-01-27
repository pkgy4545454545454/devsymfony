<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ModifierTicketTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 5]
            ])
            ->add('catégorie', ChoiceType::class, [
                'choices' => [
                    'Incident' => 'Incident',
                    'Panne' => 'Panne',
                    'Évolution' => 'Évolution',
                    'Anomalie' => 'Anomalie',
                    'Information' => 'Information'
                ]
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Nouveau' => 'Nouveau',
                    'Ouvert' => 'Ouvert',
                    'Résolu' => 'Résolu',
                    'Fermé' => 'Fermé'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'allow_extra_fields' => true
        ]);
    }
}