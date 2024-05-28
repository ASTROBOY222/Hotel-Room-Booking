document.getElementById('roomForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const description = document.getElementById('description').value;
    const price = document.getElementById('price').value;
    const available = document.getElementById('available').value;

    let resultMessage = `
        <p><strong>Room Description:</strong> ${description}</p>
        <p><strong>Price:</strong> $${price}</p>
        <p><strong>Available:</strong> ${available}</p>
    `;

    document.getElementById('result').innerHTML = resultMessage;
});