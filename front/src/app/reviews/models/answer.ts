import { Question } from "./question";

export interface Answer {
    id?: number;
    questionId: Question;
    rating: number;
    comment: string;
}