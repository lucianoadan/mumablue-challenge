import { Component, Input } from '@angular/core';
import { Shipment } from '../../models/shipment';


@Component({
  selector: 'app-shipment-list',
  templateUrl: './shipment-list.component.html',
  styleUrls: ['./shipment-list.component.css']
})
export class ShipmentListComponent {
  shipment: Shipment = null;
  @Input() shipments: Shipment[] = [];

  public select(shipment: Shipment) {
    this.shipment = shipment;
  }
}