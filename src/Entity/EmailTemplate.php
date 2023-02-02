<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class EmailTemplate
{

    private ?string $addressFrom = null;

    private ?string $addressTo = null;

    private ?string $subject = null;

    private ?string $htmlTemplate = null;

    public function getFrom(): ?string
    {
        return $this->addressFrom;
    }

    public function setFrom(string $addressFrom): self
    {
        $this->addressFrom = $addressFrom;

        return $this;
    }

    public function getTo(): ?string
    {
        return $this->addressTo;
    }

    public function setTo(string $addressTo): self
    {
        $this->addressTo = $addressTo;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getHtmlTemplate(): ?string
    {
        return $this->htmlTemplate;
    }

    public function setHtmlTemplate(string $htmlTemplate): self
    {
        $this->htmlTemplate = $htmlTemplate;

        return $this;
    }
}
