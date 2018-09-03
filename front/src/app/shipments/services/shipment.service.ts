import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

//import { Observable } from 'rxjs';
//import { map } from 'rxjs/operators';

import { Observable } from 'rxjs/Observable';
import { Subscriber } from 'rxjs/Subscriber';

import { Shipment, genMockShipmentList } from '../models/shipment';
import { ApiResponse } from '@app/core/models/api-response';
import { AppConfig } from '@app/core/cfg/app.config';
import { Country } from '../models/country';
import { COUNTRIES } from './mocks/countries';
import { Status } from '../models/status';
import { STATUSES, STATUS_GROUPS } from './mocks/statuses';
import { StatusGroup } from '../models/status-group';

@Injectable({
    providedIn: 'root',
})
export class ShipmentService {
    private API_PATH = AppConfig.API_BASE_URL + '/shipments';

    constructor(private http: HttpClient) { }

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
    availableCountries(): Observable<Country[]> {
        return Observable.create((observer: Subscriber<any>) => {
            observer.next(COUNTRIES);
            observer.complete();
        });
    }
    statuses(): Observable<StatusAndGroups> {
        return Observable.create((observer: Subscriber<any>) => {
            observer.next({ statuses: STATUSES, groups: STATUS_GROUPS});
            observer.complete();
        });
    }
}

/* Requests */
export interface StatusAndGroups {
    statuses: Status[],
    groups: StatusGroup[]
}