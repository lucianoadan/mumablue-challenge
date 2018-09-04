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
import { COUNTRIES } from './mocks/countries';
import { Status } from '../models/status';
import { STATUSES, STATUS_GROUPS } from './mocks/statuses';
import { StatusGroup } from '../models/status-group';
import { ToastrService } from 'ngx-toastr';

@Injectable()
export class ShipmentService {

    private ENDPOINT = AppConfig.API_BASE_URL + '/shipments';

    constructor(private http: HttpClient) {
    }

    /**
     * Get all shipments
     */
    all(): Observable<Shipment[]> {
        return Observable.create((observer: Subscriber<any>) => {
            observer.next(genMockShipmentList());
            observer.complete();
        });
        /*return this.http
            .get<{ payload: Shipment[] }>(`${this.API_PATH}?q=${queryTitle}`)
            .pipe(map(response => response.payload || []));
        */
    }
    /**
     * Available countries for shipment
     */
    availableCountries(): Observable<Country[]> {
        return Observable.create((observer: Subscriber<any>) => {
            observer.next(COUNTRIES);
            observer.complete();
        });
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
            .post<ApiResponse<Shipment>>(this.ENDPOINT, shipment)
            .pipe(
                map(response => response.payload || null),
                catchError(this.handleError.bind(this))
            );


        /*return Observable.create((observer: Subscriber<any>) => {
            shipment.id = Math.floor((Math.random()+1)*1000);
            observer.next(shipment);
            observer.complete();
        });*/
    }

    private handleError(error: any, caught: Observable<any>): ObservableInput<{}> {

        ///return Observable.throw(error || "Server Error");
        if (error instanceof HttpErrorResponse) {
            // Server or connection error happened
            if (!navigator.onLine) {
                throwError('Parece que no tienes conexión.');
            }
            else if (error.status === 0) {
                throwError('Servidor no disponible.');
            } else {
                throwError(error.message);
            }
        } else {
            throwError('Error en la aplicación.');
        }

        return throwError("Hubo un error en el servidor.");
    }
}
/* Requests */
export interface StatusAndGroups {
    statuses: Status[],
    groups: StatusGroup[]
}