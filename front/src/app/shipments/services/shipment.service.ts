import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';

//import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

import { Observable, ObservableInput, throwError } from 'rxjs';


import { Shipment } from '../models/shipment';
import { ApiResponse } from '@app/core/models/api-response';
import { AppConfig } from '@app/core/cfg/app.config';
import { Country } from '../models/country';
import { Status } from '../models/status';
import { StatusGroup } from '../models/status-group';
import { ToastrService } from 'ngx-toastr';
import { ShipmentHeader } from '../models/shipment-header';
import { handleServiceError } from '@app/core/utils/serviceErrorHandler';
@Injectable()
export class ShipmentService {

    private API_BASE_URL = AppConfig.API_BASE_URL;

    constructor(private http: HttpClient, private toastrService: ToastrService) { }

    /**
     * Get all shipments headers
     */
    getShipments(params: any = {}): Observable<ShipmentHeader[]> {

        params.lightweight = 1;
        let header = { params: params };
        return this.http
            .get<ApiResponse<ShipmentHeader[]>>(this.API_BASE_URL + '/shipments', header)
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

    /**
     * Get all shipments headers
     */
    getShipment(id: any = {}): Observable<Shipment> {
        let header = { params: { id: id } };
        return this.http
            .get<ApiResponse<Shipment>>(this.API_BASE_URL + '/shipments/' + id)
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

    /**
     * Available countries for shipment
     */
    availableCountries(): Observable<Country[]> {
        return this.http
            .get<ApiResponse<Country[]>>(this.API_BASE_URL + '/countries/available')
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

    /**
     * Available countries for shipment
     */
    getActualStatuses(): Observable<Status[]> {
        return this.http
            .get<ApiResponse<Status[]>>(this.API_BASE_URL + '/status/actual')
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

    /**
     * Available countries for shipment
     */
    getStatusGroups(): Observable<StatusGroup[]> {
        return this.http
            .get<ApiResponse<StatusGroup[]>>(this.API_BASE_URL + '/status-group')
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

    /**
     * Create a shipment. 
     * Getting as answer the shipment itself with the tracking number and label
     * @param shipment 
     */
    create(shipment: Shipment): Observable<Shipment> {
        return this.http
            .put<ApiResponse<Shipment>>(this.API_BASE_URL + '/shipments', shipment)
            .pipe(
                map(response => response.payload || null),
                catchError(handleServiceError.bind(this))
            );
    }

}