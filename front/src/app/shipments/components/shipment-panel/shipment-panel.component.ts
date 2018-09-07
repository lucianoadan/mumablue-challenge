import { Component } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { ShipmentService } from '../../services/shipment.service';
import { Status } from '../../models/status';
import { StatusGroup } from '../../models/status-group';
import { NgbModal, NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { ShipmentFormComponent } from '../shipment-form';
import { Country } from '../../models/country';
import { FormSelectOption } from '../../../core/components/form-field.component';
import { ShipmentHeader } from '../../models/shipment-header';



@Component({
  selector: 'app-shipment-panel',
  templateUrl: './shipment-panel.component.html',
  styleUrls: ['./shipment-panel.component.css']
})
export class ShipmentPanelComponent {
  ALL_GROUP: StatusGroup = {
    id: 0,
    code: 'all',
    name: 'Todos',
    color: '',
    icon: 'fa-bars',
  };
  shipments: ShipmentHeader[] = [];
  statuses: Status[] = [];
  statusGroups: StatusGroup[];
  availableCountries: Country[];
  countryOptions: FormSelectOption[];
  // filters
  selectedGroup: StatusGroup = null;
  selectedStatus: Status = null;
  // modal
  shipmentFormModal: NgbModalRef;


  constructor(private shipmentService: ShipmentService, private modalService: NgbModal) {

    this.fetchShipments();

    this.shipmentService.availableCountries().subscribe((countries: Country[]) => {
      this.availableCountries = countries;
      this.countryOptions = this.availableCountries.map((a) => {
        return { value: a.id, label: a.name };
      });
    });

    this.shipmentService.getActualStatuses().subscribe((statuses: Status[]) => {
      this.statuses = statuses;
    });

    this.shipmentService.getStatusGroups().subscribe((statusGroups: StatusGroup[]) => {
      this.statusGroups = statusGroups;
      this.selectedGroup = this.ALL_GROUP;
      this.statusGroups.unshift(this.ALL_GROUP);

    });


  }

  private fetchShipments(filters = {}) {
    this.shipmentService.getShipments(filters).subscribe((shipments: ShipmentHeader[]) => {
      this.shipments = shipments;
    });
  }

  open() {
    this.shipmentFormModal = this.modalService.open(ShipmentFormComponent, { size: 'lg', keyboard: false });
    this.shipmentFormModal.componentInstance.modal = this.shipmentFormModal;
    this.shipmentFormModal.componentInstance.availableCountries = this.availableCountries;
    this.shipmentFormModal.componentInstance.countryOptions = this.countryOptions;

    this.shipmentFormModal.componentInstance.onSuccess.subscribe((shipment) => {
      this.fetchShipments();
      // do something
    });

  }

  public selectStatus(status: Status) {
    this.selectedStatus = status;
    this.selectedGroup = null;
    this.fetchShipments({ status_id: status.id});
  }
  public selectGroup(group: StatusGroup) {
    this.selectedStatus = null;
    this.selectedGroup = group;
    if(this.selectedGroup.code == 'all')
      this.fetchShipments();
    else
      this.fetchShipments({ status_group_id: group.id});
  }
}