import { Component, Input, ViewChild, AfterViewInit, Output, EventEmitter } from '@angular/core';
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
  @Input() availableCountries: Country[] = [];
  @Input() countryOptions: FormSelectOption[];
  @Output() onSuccess: EventEmitter<Shipment> = new EventEmitter<Shipment>();
  form: FormGroup;
  showVat: boolean = false;
  loading: boolean = false;
  formErrors = null;
  @ViewChild('firstnameInput') firstnameInputRef;


  public constructor(private shipmentService: ShipmentService, private toastrService: ToastrService, private fb: FormBuilder) {
    this.buildForm(fb);
  }

  ngAfterViewInit(): void {
    this.firstnameInputRef.inputRef.nativeElement.focus();
  }

  private buildForm(fb: FormBuilder) {
    // FORM
    this.form = fb.group({
      orderRef: new FormControl('', Validators.required),
      deliveryInstructions: new FormControl(''),
      shipToAddr: new FormGroup({
        firstname: new FormControl('', Validators.required),
        lastname: new FormControl('', Validators.required),
        email: new FormControl('', Validators.compose([Validators.required, Validators.email])),
        phone: new FormControl('', Validators.required),
        companyName: new FormControl('', Validators.required),
        vat: new FormControl(null),
        address: new FormControl('', Validators.required),
        address2: new FormControl(''),
        city: new FormControl('', Validators.required),
        zip: new FormControl('', Validators.required),
        state: new FormControl('', Validators.required),
        country: new FormControl('', Validators.required),

      })
    });

  }
  public onChangeCountry(countryCode) {
    let country = this.availableCountries.find((check) => check.id == countryCode);
    this.enableVatField(country.invoice);
  }
  private enableVatField(enable) {
    this.showVat = enable;
    if (!enable)
      this.form.get('shipToAddr').get('vat').setValue('');

  }

  public onSubmit() {
    if (!this.form.valid)
      return;

    this.loading = true;
    this.shipmentService.create(this.form.value).subscribe((shipment: Shipment) => {
      this.toastrService.success('Solicitud de envío creada satisfactoriamente.');
      this.onSuccess.emit(shipment);
      setTimeout(() => {
        this.modal.close();
        this.loading = false;
        this.formErrors = null;
      }, 500);
    }, (error) => {
      // Keep open so you may retry
      this.formErrors = error.errors;
      
      this.loading = false;
    });
  }

}