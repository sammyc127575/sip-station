const express = require('express');
const router = express.Router();
const mpesaClient = require('./mpesaClient');

// Route to initiate payment
router.post('/payment', async (req, res) => {
    try {
        const { amount, phoneNumber } = req.body;
        const response = await mpesaClient.initiatePayment(amount, phoneNumber);
        res.status(200).json(response);
    } catch (error) {
        res.status(500).json({ error: 'Payment initiation failed', details: error.message });
    }
});

// Route to check payment status
router.get('/payment/status/:transactionId', async (req, res) => {
    try {
        const { transactionId } = req.params;
        const response = await mpesaClient.checkPaymentStatus(transactionId);
        res.status(200).json(response);
    } catch (error) {
        res.status(500).json({ error: 'Failed to check payment status', details: error.message });
    }
});

// Route to handle M-PESA callbacks
router.post('/payment/callback', (req, res) => {
    // Handle the callback from M-PESA
    console.log('M-PESA Callback:', req.body);
    res.status(200).send('Callback received');
});

module.exports = router;