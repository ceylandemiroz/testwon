<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        //recherche texte
        ->add('string', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Votre recherche'
            ]
            
        ])
        ->add('categories', EntityType::class,[
            'required' =>false,
            'class' => Category::class,
            //'query_builder' => function (EntityRepository $er) {
             //   return $er->createQueryBuilder('c')
            //        ->where('c.parent is null');
           // },
            'label' => false,
            'multiple' => true,
            'property_path' => null,
            'expanded' =>true
            
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'filtrer',
            'attr' => [
                'class' => 'btn-block btn-info'
            ]

        ])
        ;
        
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}