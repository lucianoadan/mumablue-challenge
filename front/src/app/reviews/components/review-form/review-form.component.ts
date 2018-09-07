import { Component, Input, ViewChild, AfterViewInit, Output, EventEmitter } from '@angular/core';
import { Review } from '../../models/review';
import { Question } from '../../models/question';

import { Validators, FormBuilder, FormControl, FormGroup, FormArray } from '@angular/forms';
import { ReviewService } from '../../services/review.service';
import { NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute } from '@angular/router';
import { ShipmentService } from '../../../shipments/services/shipment.service';
import { Shipment } from '../../../shipments/models/shipment';



@Component({
  selector: 'app-review-form',
  templateUrl: './review-form.component.html',
  styleUrls: ['./review-form.component.css']
})
export class ReviewFormComponent {
  questions: Question[] = null;
  form: FormGroup = null;
  showVat: boolean = false;
  loading: boolean = false;
  formErrors = null;
  ratings = [1, 2, 3, 4, 5];
  forceLight = [0, 0];
  shipment: Shipment = null;
  sent: boolean = false;
  invalid: boolean = false;
  public constructor(private route: ActivatedRoute, private shipmentService: ShipmentService, private reviewService: ReviewService, private toastrService: ToastrService, private fb: FormBuilder) {
    this.route.params.subscribe(params => {

      const id = Number(params['id']);
      this.shipmentService.getShipment(id).subscribe((shipment: Shipment) => {
        if (shipment === null) {
          this.invalid = true;
          return;
        }
        this.shipment = shipment;
        this.reviewService.getQuestions().subscribe((questions: Question[]) => {
          this.questions = questions;
          this.buildForm(fb);
        });
      })

    });

  }


  private buildForm(fb: FormBuilder) {
    let answersArray = [];
    let item;
    this.questions.forEach((question) => {
      item = fb.group({
        questionId: new FormControl(question.id, Validators.required),
        comment: new FormControl('', question.enableComment ? Validators.required : null),
        rating: new FormControl(0, question.enableRating ? Validators.required : null),
      });
      answersArray.push(item);
    })
    // FORM
    this.form = fb.group({
      shipmentId: new FormControl(this.shipment.id, Validators.required),
      answers: fb.array(answersArray)
    });

  }

  public rate(rating, i) {
    const arrControl = this.form.get('answers') as FormArray;
    arrControl.at(i).get('rating').setValue(rating);
    console.log('rate question', i, ' with ', rating);
  }
  public forceLightOn(i, rating) {
    this.forceLight = [i, rating];
  }
  public clearForceLight(i, rating) {
    this.forceLight = [0, 0];
  }
  public lightOn(i, rating) {
    const arrControl = this.form.get('answers') as FormArray;

    if (i == this.forceLight[0] && this.forceLight[1] >= rating)
      return true;
    if (arrControl.at(i).get('rating').value >= rating)
      return true;

    return false;
  }
  public onSubmit() {
    if (!this.form.valid)
      return;

    this.loading = true;
    this.reviewService.create(this.form.value).subscribe((review: Review) => {
      this.toastrService.success('Gracias por tu tiempo.');
      this.loading = false;
      this.sent = true;
    }, (error) => {
      // Keep open so you may retry
      this.formErrors = error.errors;

      this.loading = false;
    });
  }

}