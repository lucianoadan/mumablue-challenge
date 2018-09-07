import { Answer } from "./answer";

export interface Review {
    id?:number;
    shipmentId: number;
    answers: Answer[];
}