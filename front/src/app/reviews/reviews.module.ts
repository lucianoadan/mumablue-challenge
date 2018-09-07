import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { ReviewFormComponent } from './components/review-form';

import { ReviewsRoutingModule } from './reviews-routing.module';


import { ReviewService } from './services/review.service';

import { HttpClientModule } from '@angular/common/http';
import { CoreModule } from '@app/core/core.module';





const COMPONENTS = [
  ReviewFormComponent
];

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    ReactiveFormsModule,
    ReviewsRoutingModule,
    CoreModule,
    ToastrModule.forRoot(),
    NgbModule.forRoot()
  ],
  providers: [ ReviewService ],
  exports: COMPONENTS,
  declarations: COMPONENTS,
})
export class ReviewsModule { }