import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { ShipmentFormComponent } from './components/shipment-form';
import { ShipmentPanelComponent } from './components/shipment-panel';
import { ShipmentListComponent } from './components/shipment-list';
import { ShipmentListItemComponent } from './components/shipment-list-item';

import { ShipmentsRoutingModule } from './shipments-routing.module';


import { ShipmentService } from './services/shipment.service';
import { FormFieldComponent } from '@app/core/components/form-field.component';
import { PaginationComponent } from '@app/core/components/pagination.component';

import { HttpClientModule } from '@angular/common/http';





const COMPONENTS = [
  ShipmentFormComponent,
  ShipmentPanelComponent,
  ShipmentListComponent,
  ShipmentListItemComponent,
  FormFieldComponent,
  PaginationComponent
];

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    ReactiveFormsModule,
    ShipmentsRoutingModule,
    NgbModule
  ],
  providers: [ ShipmentService ],
  exports: COMPONENTS,
  declarations: COMPONENTS,
})
export class ShipmentsModule { }