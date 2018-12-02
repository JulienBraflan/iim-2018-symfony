<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $sujet;

    /**
    * @var string|null
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @return null|string
     */
    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    /**
     * @param null|string $sujet
     * @return Contact
     */
    public function setSujet(?string $sujet): Contact
    {
        $this->sujet = $sujet;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->sujet = $message;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->sujet;
    }

    /**
     * @param null|string $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->sujet = $email;
        return $this;
    }

}