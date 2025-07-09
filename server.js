const express = require('express');
const bodyParser = require('body-parser');
const mpesaRoutes = require('./mpesa/mpesaRoutes');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

// M-PESA Routes
app.use('/api/mpesa', mpesaRoutes);

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});