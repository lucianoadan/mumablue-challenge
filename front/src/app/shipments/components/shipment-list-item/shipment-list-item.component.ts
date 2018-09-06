import { Component, Input } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { ShipmentHeader } from '../../models/shipment-header';
import { ShipmentService } from '../../services/shipment.service';


@Component({
  selector: 'app-shipment-list-item',
  templateUrl: './shipment-list-item.component.html',
  styleUrls: ['./shipment-list-item.component.css']
})
export class ShipmentListItemComponent {
  @Input() shipmentHdr: ShipmentHeader = null;
  shipment: Shipment = null;
  opened = false;
  constructor(private shipmentService: ShipmentService) { }
  get lastStatusColor() {
    return this.shipmentHdr.statusGroupColor !== null ? 'text-' + this.shipmentHdr.statusGroupColor : ''
  }
  get mailToLink() {
    const subject = "Información sobre pedido " + this.shipment.orderRef;
    const body = "Estimado " + this.shipment.shipToAddr.firstname + " " + this.shipment.shipToAddr.lastname + ' ,';
    return "mailto:" + this.shipment.shipToAddr.email + "?subject=" + subject + "&body=" + body;
  }
  open() {
    this.opened = true;
  }

  toggle() {
    this.opened = !this.opened;
    if (this.opened && this.shipment === null) {
      this.shipmentService.getShipment(this.shipmentHdr.id)
        .subscribe((shipment: Shipment) => {
          this.shipment = shipment
        })
    }
  }

}