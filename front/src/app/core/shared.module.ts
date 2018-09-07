import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';

import { FormFieldComponent } from './components/form-field.component';
import { PaginationComponent } from './components/pagination.component';

import { HttpClientModule } from '@angular/common/http';
import { FormFieldErrorsComponent } from './components/form-field-errors.component';

const COMPONENTS = [
  FormFieldComponent,
  FormFieldErrorsComponent,
  PaginationComponent
];

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  exports: COMPONENTS,
  declarations: COMPONENTS,
})
export class SharedModule { }