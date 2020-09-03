<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Type;
/* Ce formulaire va contenir les champ nom,prix,image file, ... 
et qui se pointe vers l'entité Type */ 

class AlimentType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('imageFile',FileType::class,['required'=>false])
            ->add('calorie')
            ->add('proteine')
            ->add('glucide')
            ->add('lipide')
            ->add('type',EntityType::class,['class' => Type::class,'choice_label'=>'libelle'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
