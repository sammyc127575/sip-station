// src/mpesa/mpesaClient.js



const BASE_URL = 'https://sandbox.safaricom.co.ke'; // Use the sandbox URL for testing
const SHORTCODE = process.env.MPESA_SHORTCODE;
const LIPA_NA_MPESA_URL = `${BASE_URL}/mpesa/stkpush/v1/processrequest`;
const CREDENTIALS = Buffer.from(`${process.env.MPESA_SHORTCODE}:${process.env.MPESA_PASSKEY}`).toString('base64');

const initiatePayment = async (amount, phoneNumber) => {
    const payload = {
        BusinessShortCode: SHORTCODE,
        Password: CREDENTIALS,
        Timestamp: new Date().toISOString().replace(/[-:.]/g, '').slice(0, 14),
        TransactionType: 'CustomerPayBillOnline',
        Amount: amount,
        PartyA: phoneNumber,
        PartyB: SHORTCODE,
        PhoneNumber: phoneNumber,
        CallBackURL: process.env.MPESA_CALLBACK_URL,
        AccountReference: 'Bablaz',
        TransactionDesc: 'Payment for drinks'
    };

    try {
        const response = await axios.post(LIPA_NA_MPESA_URL, qs.stringify(payload), {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                Authorization: `Basic ${CREDENTIALS}`
            }
        });
        return response.data;
    } catch (error) {
        throw new Error(`Payment initiation failed: ${error.response.data}`);
    }
};

const checkPaymentStatus = async (checkoutRequestId) => {
    const url = `${BASE_URL}/mpesa/transactionstatus/v1/query`;
    const payload = {
        // Add necessary fields for checking payment status
    };

    try {
        const response = await axios.post(url, qs.stringify(payload), {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                Authorization: `Basic ${CREDENTIALS}`
            }
        });
        return response.data;
    } catch (error) {
        throw new Error(`Payment status check failed: ${error.response.data}`);
    }
};

const handleCallback = (req, res) => {
    // Handle the callback from M-PESA here
    console.log('Callback received:', req.body);
    res.status(200).send('Callback processed');
};

module.exports = {
    initiatePayment,
    checkPaymentStatus,
    handleCallback
};