<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class Image
{

    public function __toString() {
        return $this->imagePath;
    }
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a JPEG file.")
     * @Assert\File(mimeTypes={ "application/jpeg" })
     */
    public $imagePath;
    
    

   // public function getFormField() {
   //     return $this;   /* or an array with only the needed attributes */
   // }

    public function getImage()
    {
        return $this->imagePath;
    }

    
    public function setImage($path)
    {
        $this->imagePath = $path;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User", inversedBy="images")
     */
    private $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    


}