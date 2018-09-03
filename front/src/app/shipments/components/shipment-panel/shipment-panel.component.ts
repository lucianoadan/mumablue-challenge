import { Component } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { ShipmentService, StatusAndGroups } from '../../services/shipment.service';
import { Status } from '../../models/status';
import { StatusGroup } from '../../models/status-group';



@Component({
  selector: 'app-shipment-panel',
  templateUrl: './shipment-panel.component.html',
  styleUrls: ['./shipment-panel.component.css']
})
export class ShipmentPanelComponent {
  shipment: Shipment = null;
  shipments: Shipment[] = [];
  statuses: Status[] = [];
  statusGroups: StatusGroup[];
  // filters
  selectedGroup: StatusGroup = null;
  selectedStatus: Status = null;

  constructor(private shipmentService: ShipmentService) {
    this.shipmentService.all().subscribe((shipments: Shipment[]) => {
      this.shipments = shipments;
      this.shipment = shipments[0];
    });

    this.shipmentService.statuses().subscribe((res: StatusAndGroups) => {
      this.statuses = res.statuses;
      this.statusGroups = res.groups;
      for (let i = 0; i < res.groups.length; i++) {
        if (res.groups[i].code == 'all')
          this.selectedGroup = res.groups[i];
      }
    });
  }

  public selectStatus(status: Status) {
    this.selectedStatus = status;
    this.selectedGroup = null;
  }
  public selectGroup(group: StatusGroup) {
    this.selectedStatus = null;
    this.selectedGroup = group;
  }
}