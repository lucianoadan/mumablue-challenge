import { Component, Input, OnInit, AfterViewInit, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { FormControl, FormGroup, AbstractControl } from '@angular/forms';

@Component({
    selector: 'app-form-field',
    template: `
    <div *ngIf="fg" [formGroup]="fg" class="form-group has-float-label" >
        <label>{{label}}<i *ngIf="!optional">*</i></label>
        <ng-container *ngIf="isText">
            <input #input (change)="change($event)" [formControlName]="name" type="{{type}}" class="form-control"  />
        </ng-container>
        <ng-container *ngIf="isSelect">
            <select (ngModelChange)="change($event)" [formControlName]="name" class="form-control"  >
            <option *ngFor="let opt of values" [ngValue]="opt.value"  > {{ opt.label }}</option>
            </select>
        </ng-container>
        <ng-container *ngIf="isTextarea">
            <textarea #input (change)="change($event)" [formControlName]="name" class="form-control"></textarea>
        </ng-container>
        <form-field-errors [control]="fc" ></form-field-errors>
        
    </div>
    `
})
export class FormFieldComponent implements OnInit {
    @Input() label: string = null;
    @Input() validText: string = null;
    @Input() invalidText: string = null;
    @Input() type: string = "text";
    @Input() values: FormSelectOption[] = [];
    @Input() name: string;
    @Input() fg: FormGroup;
    @Input() optional: boolean = false;
    @Output() changed: EventEmitter<any> = new EventEmitter<any>();
    @ViewChild('input') inputRef: ElementRef;
    fc: AbstractControl;
    isSelect = false;
    isTextarea = false;
    isText = true;

    public change($event) {
        this.changed.emit($event);
    }
    public ngOnInit() {
        if (this.fg) {
            this.fc = this.fg.get(this.name);
            this.isSelect = this.type === "select";
            this.isTextarea = this.type === "textarea";
            this.isText = !this.isSelect && !this.isTextarea;
        }
    }
}


export interface FormSelectOption {
    value: string;
    label: string;
}