<?php

namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterDto
{

    #[Assert\NotBlank]
    #[Assert\Length(max: 180)]
    public ?string $username = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 180)]
    #[Assert\Email]
    public ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 180)]
    public ?string $password = null;

}