// show-errors.component.ts
import { Component, Input } from '@angular/core';
import {  AbstractControl } from '@angular/forms';

@Component({
  selector: 'form-field-errors',
  template: `
   <ul *ngIf="shouldShowErrors()" class="invalid-feedback">
     <li *ngFor="let error of listOfErrors()">{{error}}</li>
   </ul>
 `,
})
export class FormFieldErrorsComponent {

  private static readonly errorMessages = {
    'required': () => 'Campo obligatorio',
    'minlength': (params) => 'La longitud mínima es de ' + params.requiredLength + 'caracteres',
    'maxlength': (params) => 'La longitud máxima es de ' + params.requiredLength + 'caracteres',
    'pattern': (params) => 'Patrón esperado: ' + params.requiredPattern,
    'email': (params) => 'El email no es válido',
  };

  @Input()
  private control: AbstractControl;
  shouldShowErrors(): boolean {
    const showErrors = this.control &&
      this.control.errors &&
      (this.control.dirty || this.control.touched);

    return showErrors;
  }

  listOfErrors(): string[] {
    return Object.keys(this.control.errors)
      .map(field => this.getMessage(field, this.control.errors[field]));
  }

  private getMessage(type: string, params: any) {
    return FormFieldErrorsComponent.errorMessages[type](params);
  }

}