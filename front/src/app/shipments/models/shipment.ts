import { Address } from './address';
import { StatusUpdate } from './status-update';

export interface IShipment {
    id: number;
    orderRef: string;
    trackingNum: string;
    deliveryInstructions: string;
    shipToAddr: Address;
    statuses: StatusUpdate[];
}

export class Shipment implements IShipment{
    id: number;
    orderRef: string;
    trackingNum: string;
    deliveryInstructions: string;
    shipToAddr: Address;
    statuses: StatusUpdate[];


}