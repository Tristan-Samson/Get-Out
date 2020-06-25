<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Quest;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Description')
            ->add('type' , null , ['empty_data' => 3])
            ->add('exp')
            ->add('equipement', EntityType::class, ['class'=>Equipement::class, 'choice_label'=>'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quest::class,
        ]);
    }
}
