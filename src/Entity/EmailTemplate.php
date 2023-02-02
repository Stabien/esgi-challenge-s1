<?php

namespace App\Entity;

class EmailTemplate
{
    public ?string $addressFrom = null;
    
    public ?string $addressTo = null;
    
    public ?string $subject = null;
    
    public ?string $htmlTemplate = null;

    public ?string $htmlTemplatePath = null;
}
