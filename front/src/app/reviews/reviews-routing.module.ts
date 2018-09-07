import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ReviewFormComponent } from './components/review-form';

export const routes: Routes = [
    { path: ':id', component: ReviewFormComponent }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
})
export class ReviewsRoutingModule { }