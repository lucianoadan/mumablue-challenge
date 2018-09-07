import { Observable, ObservableInput, throwError } from 'rxjs';
import { HttpErrorResponse } from '@angular/common/http';

export function handleServiceError(error: any, caught: Observable<any>): ObservableInput<{}> {
    let finalError;
    if (error instanceof HttpErrorResponse) {

        if (!navigator.onLine) { // Server or connection error happened
            finalError = { message: 'Parece que no tienes conexión en tu dispositivo.' };
        }
        else if (error.status === 0) {
            finalError = { message: 'Servidor no disponible.' };
            // Custom server exception
        } else if (typeof error.error !== "undefined") {
            finalError = error.error;
        }
        else {
            finalError = error;
        }
    }
    else {
        finalError = { message: "Error desconocido." };
    }
    if(typeof this.toastrService !== "undefined")
        this.toastrService.error(finalError.message, 'Error');
        
    return throwError(finalError);
}