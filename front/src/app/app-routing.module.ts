import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


export const routes: Routes = [
  { path: '', redirectTo: '/shipments', pathMatch: 'full' },
  {
    path: 'shipments',
    loadChildren: '@app/shipments/shipments.module#ShipmentsModule',

  }
  //{ path: '**', component: NotFoundPageComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { useHash: true })],
  exports: [RouterModule],
})

export class AppRoutingModule { }