<?php

namespace MyBundle\Types;


use MyBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\DataTransformerInterface;


class AttachmentsTransform implements DataTransformerInterface
{

    public function transform($value)
    {

    }

    public function reverseTransform($files)
    {
        $attachments = [];
        foreach($files as $file){
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('var/www/docker/symfony/public/uploads/userImage/'.$fileName, $fileName);
            $attachment = new \MyBundle\Entity\Image();
            $attachment->setImage('public/uploads/userImage/'.$fileName);
            $attachments[] = $attachment;
        }
        return $attachments;
    }
}