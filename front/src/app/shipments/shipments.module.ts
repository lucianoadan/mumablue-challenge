import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';


import { ShipmentFormComponent } from './components/shipment-form';
import { ShipmentPanelComponent } from './components/shipment-panel';
import { ShipmentsRoutingModule } from './shipments-routing.module';


const COMPONENTS = [
  ShipmentFormComponent,
  ShipmentPanelComponent
];

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    ShipmentsRoutingModule,
    NgbModule
  ],
  exports: COMPONENTS,
  declarations: COMPONENTS,
})
export class ShipmentsModule { }