import { Status } from "./status";

export interface StatusUpdate extends Status {
    status: Status;
    createdAt: Date;
}
