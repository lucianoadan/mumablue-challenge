import { Address } from './address';
import { StatusUpdate } from './status-update';

export interface Shipment {
    id: number;
    orderRef: string;
    trackingNum: string;
    deliveryInstructions: string;
    shipToAddr: Address;
    statuses: StatusUpdate[];
}
