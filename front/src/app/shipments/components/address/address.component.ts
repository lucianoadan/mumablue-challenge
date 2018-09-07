import { Component, Input, ViewChild, AfterViewInit, Output, EventEmitter } from '@angular/core';
import { Address } from '../../models/address';
import { Validators, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ShipmentService } from '../../services/shipment.service';
import { Country } from '../../models/country';
import { FormSelectOption } from '@app/core/components/form-field.component';
import { NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';



@Component({
  selector: 'app-address',
  styleUrls: ['./address.component.css'],
  template: `
    <address>
      <div><strong>{{ address.firstname }} {{ address.lastname }}</strong></div>
      <div>{{ address.address }}</div>
      <div>{{ address.address2 }}</div>
      <div>{{ address.zip }} {{ address.city }}</div>
      <div>{{ address.state }}</div>
      <div>{{ address.country.name }}</div>
    </address>
  `

})
export class AddressComponent {


  @Input() address: Address;



}