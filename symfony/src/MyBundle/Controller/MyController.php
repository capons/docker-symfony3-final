<?php

namespace MyBundle\Controller;

use MyBundle\Entity\Image;
use MyBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use MyBundle\Types\UploadType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MyController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function indexAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UploadType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $images = $user->images;
            $em = $this->getDoctrine()->getManager();
            $password = $user->getPassword();
            $encoder=$this->container->get('security.password_encoder');
            $pwd=$encoder->encodePassword($user, $password);
            $user->setPassword($pwd);
            $em->persist($user);
            foreach($images as $image)
            {
                $image->setUser($user);
                $em->persist($image);
            }
            $em->flush();
            return $this->redirectToRoute('test');
        }
        // replace this example code with whatever you need
        return $this->render('my/reg.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user_reg", name="reg")
     */
    public function registerAction() {

    }
}
