<?php

namespace App\Form;

use App\Entity\Dish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dish_name',null, ['label' => 'Nome do prato'])
            ->add('image',FileType::class, ['label' => 'Imagem do prato', 'mapped' => false])
            ->add('dish_description', null, ['label' => 'Descrição do prato'])
            ->add('price',null,['label' => 'Preço'])
            ->add('save_dish', SubmitType::class, ['label' => 'Salvar prato'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dish::class,
        ]);
    }
}
