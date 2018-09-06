export interface ShipmentHeader {
    id: number,
    orderRef: string;
    statusId: number;
    statusCode: string;
    statusName: string;
    statusGroupId: string;
    statusGroupCode: string;
    statusGroupName: string;
    statusGroupColor: string;
    createdAt: Date;
}