import { STATUSES } from '../services/mocks/statuses';
import { Address } from './address';
import { Status } from './status';
import { ShipmentStatus } from './shipment-status';

export interface Shipment {
    id: number;
    orderRef: string;
    trackingNum: string;
    deliveryInstructions: string;
    shipToAddr: Address;
    statuses: ShipmentStatus[];
}

export function genMockShipmentList() {
    let list = [];
    for (let i = 0; i < 5; i++)
        list.push(genMockShipment(i + 1));
    return list;

}
export function genMockShipment(id = 1) {

    function randomDate(start, end) {
        return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
    }
    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 15; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


    let rs = [];
    let n = Math.floor(Math.random() * 5) + 1;
    let s;
    for (let i = 0; i < n; i++) {
        s = STATUSES[Math.floor(Math.random() * STATUSES.length)];
        s.updatedAt = randomDate(new Date(2012, 0, 1), new Date());
        rs.push(s);
    }

    return {
        id: id,
        orderRef: "P000" + id,
        deliveryInstructions: "some instr",
        trackingNum: makeid(),
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
        },
        statuses: rs
    }
}