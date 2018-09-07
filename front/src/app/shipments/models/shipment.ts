import { Address } from './address';
import { StatusUpdate } from './status-update';
import { Review } from '@reviews/models/review';

export interface Shipment {
    id: number;
    orderRef: string;
    trackingNum: string;
    deliveryInstructions: string;
    shipToAddr: Address;
    statuses: StatusUpdate[];
    estDeliveryDate: Date;
    review?:Review;
}
