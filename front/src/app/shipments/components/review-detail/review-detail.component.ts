import { Component, Input} from '@angular/core';


import { NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { Review } from '@app/reviews/models/review';

@Component({
  selector: 'app-review-detail',
  templateUrl: './review-detail.component.html',
  styleUrls: ['./review-detail.component.css']
})
export class ReviewDetailComponent {

  @Input() review: Review = null;
  @Input() reviewModal: NgbModalRef;
  public constructor() {}

}