<?php
namespace App\Validator;

use Valitron\Validator;

class ShipmentRequestValidator implements ValidatorInterface
{
    private $validator;

    public function validate($data)
    {
        $v = new Validator($data);
        $v->rule('required', 'orderRef');
        $v->rule('required', 'shipToAddr');

        $this->validator = $v;
    }

    public function fails(): bool
    {
        return !$this->validator->validate();
    }

    public function errors(): ?array
    {
        return $this->validator->errors();
    }

    
}
