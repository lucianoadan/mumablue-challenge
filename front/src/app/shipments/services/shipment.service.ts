import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';

//import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

import { Observable, ObservableInput, throwError } from 'rxjs';
import { Subscriber } from 'rxjs/Subscriber';

import { Shipment } from '../models/shipment';
import { ApiResponse } from '@app/core/models/api-response';
import { AppConfig } from '@app/core/cfg/app.config';
import { Country } from '../models/country';
import { Status } from '../models/status';
import { StatusGroup } from '../models/status-group';
import { ToastrService } from 'ngx-toastr';

@Injectable()
export class ShipmentService {

    private API_BASE_URL = AppConfig.API_BASE_URL;

    constructor(private http: HttpClient, private toastrService: ToastrService) { }

    /**
     * Get all shipments
     */
    getShipments(filter = {}): Observable<Shipment[]> {

        return this.http
            .post<ApiResponse<Shipment[]>>(this.API_BASE_URL + '/shipments', filter)
            .pipe(
                map(response => response.payload || null),
                catchError(this.handleError.bind(this))
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
                catchError(this.handleError.bind(this))
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
                catchError(this.handleError.bind(this))
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
                catchError(this.handleError.bind(this))
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
                catchError(this.handleError.bind(this))
            );
    }

    private handleError(error: any, caught: Observable<any>): ObservableInput<{}> {
        let finalError;
        if (error instanceof HttpErrorResponse) {
            
            if (!navigator.onLine) { // Server or connection error happened
                finalError = { message: 'Parece que no tienes conexión en tu dispositivo.' };
            }
            else if (error.status === 0) {
                finalError = { message: 'Servidor no disponible.' };
                // Custom server exception
            } else if (typeof error.error !== "undefined") {
                finalError = error.error;
            }
            else {
                finalError = error;
            }
        }
        else{
            finalError = { message: "Error desconocido." };
        }

        this.toastrService.error(finalError.message, 'Error');
        return throwError(finalError);
    }
}