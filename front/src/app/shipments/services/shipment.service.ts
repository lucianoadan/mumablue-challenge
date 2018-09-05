import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';

//import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

import { Observable, ObservableInput, throwError } from 'rxjs';
import { Subscriber } from 'rxjs/Subscriber';

import { Shipment, genMockShipmentList } from '../models/shipment';
import { ApiResponse } from '@app/core/models/api-response';
import { AppConfig } from '@app/core/cfg/app.config';
import { Country } from '../models/country';
import { Status } from '../models/status';
import { STATUSES, STATUS_GROUPS } from './mocks/statuses';
import { StatusGroup } from '../models/status-group';

@Injectable()
export class ShipmentService {

    private API_BASE_URL = AppConfig.API_BASE_URL;

    constructor(private http: HttpClient) {
    }

    /**
     * Get all shipments
     */
    all(): Observable<Shipment[]> {
        return this.http
            .get<ApiResponse<Shipment[]>>(this.API_BASE_URL + '/shipments')
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
     * Get list of all statuses which is the last status of any shipment
     * And a list of statuses groups
     */
    statuses(): Observable<StatusAndGroups> {
        return Observable.create((observer: Subscriber<any>) => {
            observer.next({ statuses: STATUSES, groups: STATUS_GROUPS });
            observer.complete();
        });
    }
    /**
     * Create a shipment. 
     * Getting as answer the shipment itself with the tracking number and label
     * @param shipment 
     */
    create(shipment: Shipment): Observable<Shipment> {
        return this.http
            .post<ApiResponse<Shipment>>(this.API_BASE_URL + '/shipments', shipment)
            .pipe(
                map(response => response.payload || null),
                catchError(this.handleError.bind(this))
            );
    }

    private handleError(error: any, caught: Observable<any>): ObservableInput<{}> {
        if (error instanceof HttpErrorResponse) {

            if (!navigator.onLine) { // Server or connection error happened
                return throwError({ message: 'Parece que no tienes conexión en tu dispositivo.' });
            }
            else if (error.status === 0) {
                return throwError({ message: 'Servidor no disponible.' });
                // Custom server exception
            } else if (typeof error.error !== "undefined") {
                return throwError(error.error);
            }
            else {
                return throwError(error);
            }
        }

        return throwError({ message: "Error desconocido." });
    }
}
/* Requests */
export interface StatusAndGroups {
    statuses: Status[],
    groups: StatusGroup[]
}