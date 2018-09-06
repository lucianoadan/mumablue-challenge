import { StatusGroup } from "./status-group";

export interface Status {
    id: string;
    code: string;
    title: string;
    statusGroup: StatusGroup;
}