import { Component, Input } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { ShipmentHeader } from '../../models/shipment-header';
import { ShipmentService } from '../../services/shipment.service';

import { NgbModalRef, NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ReviewDetailComponent } from '../review-detail';


@Component({
  selector: 'app-shipment-list-item',
  templateUrl: './shipment-list-item.component.html',
  styleUrls: ['./shipment-list-item.component.css']
})
export class ShipmentListItemComponent {
  @Input() shipmentHdr: ShipmentHeader = null;
  shipment: Shipment = null;
  opened = false;
  reviewModal: NgbModalRef;
  constructor(private shipmentService: ShipmentService, private modalService: NgbModal) { }
  
  get lastStatusColor() {
    return this.shipmentHdr.statusGroupColor !== null ? 'text-' + this.shipmentHdr.statusGroupColor : ''
  }
  get headerStatusName() {
    if (typeof this.shipmentHdr.statusName === "undefined")
      return 'No hay estado disponible';
    return this.shipmentHdr.statusName
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

    if (!this.opened && this.shipment === null) {
      this.shipmentService.getShipment(this.shipmentHdr.id)
        .subscribe((shipment: Shipment) => {
          this.shipment = shipment
          this.opened = true;
        })
    }
    else {
      this.opened = !this.opened;
    }
  }

  openReview() {
    this.reviewModal = this.modalService.open(ReviewDetailComponent, { size: 'lg', keyboard: false });
    this.reviewModal.componentInstance.review = this.shipment.review;
    this.reviewModal.componentInstance.modal = this.reviewModal;

  }
}