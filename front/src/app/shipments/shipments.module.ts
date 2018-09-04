import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { ShipmentFormComponent } from './components/shipment-form';
import { ShipmentPanelComponent } from './components/shipment-panel';
import { ShipmentListComponent } from './components/shipment-list';
import { ShipmentListItemComponent } from './components/shipment-list-item';

import { ShipmentsRoutingModule } from './shipments-routing.module';


import { ShipmentService } from './services/shipment.service';

import { HttpClientModule } from '@angular/common/http';
import { CoreModule } from '@app/core/core.module';





const COMPONENTS = [
  ShipmentFormComponent,
  ShipmentPanelComponent,
  ShipmentListComponent,
  ShipmentListItemComponent,
];

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    ReactiveFormsModule,
    ShipmentsRoutingModule,
    CoreModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot(),
    NgbModule.forRoot()
  ],
  entryComponents: [ShipmentFormComponent], // Needed for NGB MOdal
  providers: [ ShipmentService ],
  exports: COMPONENTS,
  declarations: COMPONENTS,
})
export class ShipmentsModule { }