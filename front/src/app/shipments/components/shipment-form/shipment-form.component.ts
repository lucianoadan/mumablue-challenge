import { Component, Input, ViewChild, AfterViewInit } from '@angular/core';
import { Shipment } from '../../models/shipment';
import { Validators, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ShipmentService } from '../../services/shipment.service';
import { Country } from '../../models/country';
import { FormSelectOption } from '@app/core/components/form-field.component';
import { NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';



@Component({
  selector: 'app-shipment-form',
  templateUrl: './shipment-form.component.html'
})
export class ShipmentFormComponent implements AfterViewInit {


  @Input() modal: NgbModalRef;
  availableCountries: Country[] = [];
  countryOptions: FormSelectOption[];
  form: FormGroup;
  showVat: boolean = false;
  loading: boolean = false;
  @ViewChild('firstnameInput') firstnameInputRef;


  public constructor(private shipmentService: ShipmentService, private toastrService: ToastrService, private fb: FormBuilder) {
    this.shipmentService.availableCountries().subscribe((countries: Country[]) => {
      this.availableCountries = countries;
      this.countryOptions = countries.map((a) => {
        return { value: a.code, label: a.name };
      });

    });
    this.buildForm(fb);

    this.onSubmit();
  }

  ngAfterViewInit(): void {
    this.firstnameInputRef.inputRef.nativeElement.focus();
  }

  private buildForm(fb: FormBuilder) {
    // FORM
    this.form = fb.group({
      orderRef: new FormControl('', Validators.required),
      firstname: new FormControl('', Validators.required),
      lastname: new FormControl('', Validators.required),
      email: new FormControl('', Validators.compose([Validators.required, Validators.email])),
      deliveryInstructions: new FormControl(''),
      shipToAddr: new FormGroup({
        phone: new FormControl('', Validators.required),
        email: new FormControl('', Validators.compose([Validators.required, Validators.email])),
        companyName: new FormControl('', Validators.required),
        vat: new FormControl(''),
        address: new FormControl('', Validators.required),
        address2: new FormControl(''),
        city: new FormControl('', Validators.required),
        zip: new FormControl('', Validators.required),
        state: new FormControl('', Validators.required),
        country: new FormControl('', Validators.required),

      })
    });

  }
  public onChangeCountry($event) {
    const countryCode = $event.target.value;
    const country = this.availableCountries.find((value) => {
      return value.code == countryCode;
    });
    this.enableVatField(country.invoice);

  }
  private enableVatField(enable) {
    this.showVat = enable;
    if (enable) {
      this.form.get('shipToAddr').get('vat').enable();
    }
    else {
      this.form.get('shipToAddr').get('vat').disable();
    }
  }

  public onSubmit() {
    this.loading = true;
    this.shipmentService.create(this.form.value).subscribe((shipment: Shipment) => {
      setTimeout(() => {
        this.modal.close();
        this.loading = false;

      }, 1500);
    }, (error) => {
      console.log(error);
      // Keep open so you may retry
      this.toastrService.error(error, 'Error');
      this.loading = false;
    });
  }

}