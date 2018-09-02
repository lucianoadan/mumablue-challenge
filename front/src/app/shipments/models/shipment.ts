import { Address } from './address';

export interface Shipment {
    id: number;
    orderRef: string;
    deliveryInstructions: string;
    shipToAddr: Address;
}

export function genMockShipment() {
    return {
        id: 1,
        orderRef: "P0001",
        deliveryInstructions: "payaso",
        shipToAddr: {
            id: 1,
            address: "string",
            address2: "",
            city: "",
            zip: "",
            state: "",
            country: "",
            phone: "",
            email: ""
        }
    }
}