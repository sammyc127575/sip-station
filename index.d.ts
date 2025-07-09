// src/types/index.d.ts

declare module 'mpesa' {
    export interface MpesaPaymentResponse {
        status: string;
        message: string;
        transactionId: string;
        amount: number;
        currency: string;
        timestamp: string;
    }

    export interface MpesaPaymentStatusResponse {
        status: string;
        message: string;
        transactionId: string;
        amount: number;
        currency: string;
        timestamp: string;
    }

    export interface MpesaCallbackRequest {
        transactionId: string;
        amount: number;
        status: string;
        timestamp: string;
        phoneNumber: string;
    }

    export interface MpesaErrorResponse {
        code: string;
        message: string;
    }
}