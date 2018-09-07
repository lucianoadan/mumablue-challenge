import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { map, catchError } from 'rxjs/operators';
import { Observable, ObservableInput, throwError } from 'rxjs';
import { ApiResponse } from '@app/core/models/api-response';
import { AppConfig } from '@app/core/cfg/app.config';
import { ToastrService } from 'ngx-toastr';
import { Question } from '../models/question';
import { handleServiceError } from '@app/core/utils/serviceErrorHandler';
import { Review } from '../models/review';

@Injectable()
export class ReviewService {

    private API_BASE_URL = AppConfig.API_BASE_URL;

    constructor(private http: HttpClient, private toastrService: ToastrService) { }
    /**
     * Create a review. 
     * @param review 
     */
    create(review: Review): Observable<Review> {
        return this.http
            .put<ApiResponse<Review>>(this.API_BASE_URL + '/reviews', review)
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }
    /**
     * Get questions
     */
    getQuestions(): Observable<Question[]> {
        return this.http
            .get<ApiResponse<Question[]>>(this.API_BASE_URL + '/questions')
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }
}