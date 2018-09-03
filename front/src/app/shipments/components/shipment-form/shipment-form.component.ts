import { Component, Input, Output, EventEmitter } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { Validators, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ShipmentService } from '../../services/shipment.service';
import { Country } from '../../models/country';
import { FormSelectOption } from '../../../core/cfg/components/form-field.component';



@Component({
  selector: 'app-shipment-form',
  templateUrl: './shipment-form.component.html'
})
export class ShipmentFormComponent {

  @Input() shipment: Shipment;
  availableCountries: Country[] = [];
  countryOptions: FormSelectOption[];
  form: FormGroup;


  public constructor(private shipmentService: ShipmentService, private fb: FormBuilder) {
    this.shipmentService.availableCountries().subscribe((countries: Country[]) => {
      this.availableCountries = countries;
      this.countryOptions = countries.map((a) => {
        return { value: a.code, label: a.name };
      });
    });
    this.buildForm(fb);
  }

  private buildForm(fb: FormBuilder) {
    // FORM
    this.form = fb.group({
      phone: new FormControl('', Validators.required),
      email: new FormControl('', Validators.compose([
        Validators.required,
        Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')
      ]))
    });
  }

  get id() {
    return this.shipment.id;
  }

  get orderRef() {
    return this.shipment.orderRef;
  }

  get shipToAddr() {
    return this.shipment.shipToAddr;
  }
}