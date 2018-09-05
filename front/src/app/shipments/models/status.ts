import { StatusGroup } from "./status-group";

export interface Status {
    code: string;
    title: string;
    statusGroup: StatusGroup;
}