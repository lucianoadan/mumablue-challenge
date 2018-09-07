<?php
namespace App\Command;

use App\Service\ShipmentServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TrackShipmentsCommand extends Command
{
    private $carrierService;
    public function __construct(ShipmentServiceInterface $shipmentService)
    {
        $this->shipmentService = $shipmentService;
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setName('app:track-shipments')
            ->setDescription('Actualiza los estados de los envíos que aún no se han entregado.')
            ->setHelp('Actualiza automaticamente los estados de los pedidos');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->shipmentService->updateShipmentsStatus();
    }
}
