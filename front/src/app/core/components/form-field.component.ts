import { Component, Input, OnInit } from '@angular/core';

@Component({
    selector: 'app-form-field',
    template: `
    <div class="form-group has-float-label">
        <label>{{label}}</label>
        <ng-container *ngIf="isText">
            <input type="text" class="form-control {{ fieldClass }}" />
        </ng-container>
        <ng-container *ngIf="isSelect">
            <select class="form-control {{ fieldClass }}">
            <option *ngFor="let opt of values"  > {{ opt.label }}</option>
            </select>
        </ng-container>
        
        <div *ngIf="invalidText" class="invalid-feedback">{{invalidText}}</div>
        <div *ngIf="validText" class="valid-feedback">{{validText}}</div>
    </div>
    `
})
export class FormFieldComponent implements OnInit {
    @Input() label: string = null;
    @Input() validText: string = null;
    @Input() invalidText: string = null;
    @Input() type: string = "text";
    @Input() values: FormSelectOption[] = [];
    private fieldclass = '';
    private isSelect = false;
    private isText = true;

    public constructor(){
        
    }
    public ngOnInit(){
        this.isSelect = this.type === "select";
        this.isText = this.type === "text";
    }
}


export interface FormSelectOption {
    value: string;
    label: string;
}