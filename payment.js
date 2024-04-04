document.addEventListener('DOMContentLoaded', function() {
    // Handle click event for payment button
    document.getElementById('payment-button').addEventListener('click', function() {
        // Show payment modal
        Swal.fire({
            title: 'Select Payment Method',
            html: '<select id="payment-method" class="form-control">' +
                '<option value="mpesa">M-Pesa</option>' +
                '<option value="visa">Visa</option>' +
                '</select>' +
                '<input type="tel" id="phone-number" class="form-control" placeholder="Enter your phone number">',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            preConfirm: async () => {
                // Retrieve selected payment method and phone number
                var paymentMethod = document.getElementById('payment-method').value;
                var phoneNumber = document.getElementById('phone-number').value;

                // Handle empty phone number
                if (!phoneNumber) {
                    Swal.showValidationMessage('Please enter your phone number');
                    return;
                }

                // Handle payment method selection
                if (paymentMethod === 'mpesa') {
                    // Show M-Pesa payment details
                    Swal.fire({
                        title: 'M-Pesa Payment',
                        imageUrl: 'mpesa_logo.png', // Replace with the path to your M-Pesa logo
                        imageWidth: 200,
                        imageHeight: 100,
                        html: '<p>Total Charges: </p>',
                        showCancelButton: true,
                        confirmButtonText: 'Pay Now',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        preConfirm: async () => {
                            try {
                                const response = await fetch('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Authorization': 'Bearer A0Uwokk6zuiaUeS4zqF7d66AO5F4'
                                    },
                                    body: JSON.stringify({
                                        "BusinessShortCode": 174379,
                                        "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjQwMzI2MTAyMTMx",
                                        "Timestamp": "20240326102131",
                                        "TransactionType": "CustomerPayBillOnline",
                                        "Amount": 1,
                                        "PartyA": phoneNumber,
                                        "PartyB": 174379,
                                        "PhoneNumber": phoneNumber,
                                        "CallBackURL": "",
                                        "AccountReference": "UrbanCrew LTD",
                                        "TransactionDesc": "Payment of rentals" 
                                    })
                                });
                                if (response.ok) {
                                    const result = await response.text();
                                    console.log(result);
                                    Swal.fire('M-Pesa Payment Successful', '', 'success');
                                } else {
                                    throw new Error('Error initiating M-Pesa payment');
                                }
                            } catch (error) {
                                console.error(error);
                                Swal.fire('Error', 'An error occurred while processing your payment. Please try again later.', 'error');
                            }
                        }
                    }).then((result) => {
                        // Handle M-Pesa payment confirmation
                        if (result.isConfirmed) {
                            window.location.href = 'Thank you.html';
                        }
                    });
                } else if (paymentMethod === 'visa') {
                    // Handle Visa payment
                    Swal.fire('Visa Payment Selected', '', 'success');
                }
            }
        });
    });
});
