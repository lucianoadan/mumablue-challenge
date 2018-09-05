<?php
namespace App\Validator;

use App\Repository\{ShipmentRepository, CountryRepository};
use Valitron\Validator;

class ShipmentRequestValidator implements ValidatorInterface
{
    private $validator;
    private $countryRepository;
    private $shipmentRepository;
    private $failed;
    public function __construct(CountryRepository $countryRepository, ShipmentRepository $shipmentRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->shipmentRepository = $shipmentRepository;
    }
    public function validate($data)
    {
        $v = new Validator($data);
        $v->rule('required', 'orderRef');
        $v->rule(function ($field, $value, $params, $fields) {
            $exists = $this->shipmentRepository->existsOrderShipment($value);
            return !$exists;
        }, 'orderRef')->message("Ya se ha creado un envío para este número de pedido");
        $v->rule('required', 'shipToAddr')->message("Debes introducir la dirección de envío");
        $v->rule('required', 'shipToAddr.firstname');
        $v->rule('required', 'shipToAddr.lastname');
        $v->mapFieldRules('shipToAddr.email', ['required', 'email']);
        $v->rule('required', 'shipToAddr.phone');
        $v->rule('required', 'shipToAddr.address');
        $v->rule('optional', 'shipToAddr.address2');
        $v->rule('required', 'shipToAddr.zip');
        $v->rule('required', 'shipToAddr.city');
        $v->rule('required', 'shipToAddr.country');
        $v->rule('required', 'shipToAddr.state');
        $v->rule('optional', 'shipToAddr.vat');
        $v->rule(function ($field, $value, $params, $fields) {
            $countryId = $fields['shipToAddr']['country'];
            $country = $this->countryRepository->find($countryId);

            if ($country->getInvoice() && trim($value) === '') {
                return false;
            }
            return true;
        }, 'shipToAddr.vat')->message("VAT is required for this country");

        $this->failed = !$v->validate();
        $this->validator = $v;
    }

    public function fails(): bool
    {
        return $this->failed;
    }

    public function errors(): ?array
    {
        return $this->validator->errors();
    }

}
