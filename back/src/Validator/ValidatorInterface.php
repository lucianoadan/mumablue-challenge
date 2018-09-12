<?php
namespace App\Validator;

interface ValidatorInterface
{
    public function validate($data);

    public function fails(): bool;

    public function errors(): ?array;

}
