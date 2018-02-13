<?php

namespace MyBundle\Types;

use MyBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add($builder->create(
                'images', FileType::class, [
                    'required' => false,
                    'multiple' => true,
                
                ]
            )->addModelTransformer(new AttachmentsTransform()))
            ->add('save', SubmitType::class);
    }
}