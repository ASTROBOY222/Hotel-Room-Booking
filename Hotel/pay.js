document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const amount = document.getElementById('amount').value;
    const paymentMethod = document.getElementById('paymentMethod').value;

    let resultMessage = `
        <p><strong>Amount:</strong> $${amount}</p>
        <p><strong>Payment Method:</strong> ${paymentMethod}</p>
    `;

    document.getElementById('result').innerHTML = resultMessage;
});

document.getElementById('paymentMethod').addEventListener('change', function() {
    const paymentMethod = this.value;
    let paymentDetailsHtml = '';

    switch (paymentMethod) {
        case 'UPI':
            paymentDetailsHtml = `
                <label for="upiId">UPI ID:</label>
                <input type="text" id="upiId" name="upiId" required>
            `;
            break;
        case 'Credit Card':
            paymentDetailsHtml = `
                <label for="creditCardNumber">Card Number:</label>
                <input type="text" id="creditCardNumber" name="creditCardNumber" required>

                <label for="creditCardExpiry">Expiry Date:</label>
                <input type="month" id="creditCardExpiry" name="creditCardExpiry" required>

                <label for="creditCardCVV">CVV:</label>
                <input type="text" id="creditCardCVV" name="creditCardCVV" required>
            `;
            break;
        case 'Debit Card':
            paymentDetailsHtml = `
                <label for="debitCardNumber">Card Number:</label>
                <input type="text" id="debitCardNumber" name="debitCardNumber" required>

                <label for="debitCardExpiry">Expiry Date:</label>
                <input type="month" id="debitCardExpiry" name="debitCardExpiry" required>

                <label for="debitCardCVV">CVV:</label>
                <input type="text" id="debitCardCVV" name="debitCardCVV" required>
            `;
            break;
        case 'Net Banking':
            paymentDetailsHtml = `
                <label for="bankName">Bank Name:</label>
                <input type="text" id="bankName" name="bankName" required>
                
                <label for="accountNumber">Account Number:</label>
                <input type="text" id="accountNumber" name="accountNumber" required>
                
                <label for="ifscCode">IFSC Code:</label>
                <input type="text" id="ifscCode" name="ifscCode" required>
            `;
            break;
        default:
            paymentDetailsHtml = '';
    }

    document.getElementById('paymentDetails').innerHTML = paymentDetailsHtml;
});