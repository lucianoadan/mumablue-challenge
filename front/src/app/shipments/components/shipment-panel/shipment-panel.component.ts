import { Component } from '@angular/core';
import { Shipment, genMockShipment } from '../../models/Shipment';

@Component({
  selector: 'app-shipment-panel',
  templateUrl: './shipment-panel.component.html',
})
export class ShipmentPanelComponent {
  shipment: Shipment = genMockShipment();
}