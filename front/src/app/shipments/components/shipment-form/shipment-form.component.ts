import { Component, Input, Output, EventEmitter } from '@angular/core';
import { Shipment } from '../../models/Shipment';

@Component({
  selector: 'app-shipment-form',
  templateUrl: './shipment-form.component.html'
})
export class ShipmentFormComponent {
  
  @Input() shipment: Shipment;
 
  get id() {
    return this.shipment.id;
  }

  get orderRef() {
    return this.shipment.orderRef;
  }

  get shipToAddr() {
    return this.shipment.shipToAddr;
  }
}