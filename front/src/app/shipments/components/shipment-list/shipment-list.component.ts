import { Component, Input } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { ShipmentHeader } from '../../models/shipment-header';


@Component({
  selector: 'app-shipment-list',
  templateUrl: './shipment-list.component.html',
  styleUrls: ['./shipment-list.component.css']
})
export class ShipmentListComponent {
  @Input() shipments: ShipmentHeader[] = [];

}