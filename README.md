# Bablaz Dispensing Application

## Overview
The Bablaz Dispensing Application is a web-based solution that allows users to select and purchase drinks through an automated dispensing system. The application integrates with the M-PESA API for secure mobile payments, providing a seamless user experience.

## Project Structure
```
bablaz-dispensing-app
├── src
│   ├── mpesa
│   │   ├── mpesaClient.js       # M-PESA API client implementation
│   │   └── mpesaRoutes.js       # Routes for handling M-PESA requests
│   ├── public
│   │   ├── bablaz.html           # Main HTML file for the application
│   │   └── main.js               # Client-side JavaScript
│   ├── server.js                 # Entry point of the application
│   └── types
│       └── index.d.ts            # Type definitions for TypeScript
├── package.json                   # npm configuration file
├── .env                           # Environment variables
└── README.md                      # Project documentation
```

## Setup Instructions
1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd bablaz-dispensing-app
   ```

2. **Install Dependencies**
   Ensure you have Node.js installed, then run:
   ```bash
   npm install
   ```

3. **Configure Environment Variables**
   Create a `.env` file in the root directory and add your M-PESA API credentials:
   ```
   MPESA_CONSUMER_KEY=<your_consumer_key>
   MPESA_CONSUMER_SECRET=<your_consumer_secret>
   MPESA_SHORTCODE=<your_shortcode>
   MPESA_LIVE_URL=<live_url>
   MPESA_SANDBOX_URL=<sandbox_url>
   ```

4. **Run the Application**
   Start the server:
   ```bash
   node src/server.js
   ```

5. **Access the Application**
   Open your web browser and navigate to `http://localhost:3000` to access the Bablaz dispensing application.

## Usage
- Users can select drinks from the available options.
- Upon selection, users can proceed to checkout, where they will be prompted to pay via M-PESA.
- The application handles payment confirmation and dispensing of drinks.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License.