<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class EmailTemplate
{
    public ?string $addressFrom = null;
    
    public ?string $addressTo = null;
    
    public ?string $subject = null;
    
    public ?string $htmlTemplate = null;

    public ?string $htmlTemplatePath = null;
}
