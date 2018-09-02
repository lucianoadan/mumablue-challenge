import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ShipmentPanelComponent } from './components/shipment-panel';

export const routes: Routes = [
    { path: '', component: ShipmentPanelComponent }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
})
export class ShipmentsRoutingModule { }