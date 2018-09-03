import { Component, Input } from '@angular/core';
import { Shipment } from '../../models/shipment';


@Component({
  selector: 'app-shipment-list-item',
  templateUrl: './shipment-list-item.component.html',
  styleUrls: ['./shipment-list-item.component.css']
})
export class ShipmentListItemComponent {
  @Input() shipment: Shipment = null;
  opened = false;
  constructor() {

  }
  get orderRef() {
    return this.shipment.orderRef;
  }
  get statuses() {
    return this.shipment.statuses;
  }
  get lastStatus() {
    if (this.shipment.statuses.length == 0)
      return null;

    let last = this.shipment.statuses.length - 1;

    return this.shipment.statuses[last];
  }
  open() {
    this.opened = true;
  }

  toggle() {
    this.opened = !this.opened;
  }

}