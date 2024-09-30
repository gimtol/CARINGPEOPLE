function showPaymentForm(method) {
    // Ocultar todos los formularios de pago
    document.querySelectorAll('.payment-form').forEach(form => {
        form.style.display = 'none';
    });

    // Mostrar el formulario correspondiente
    if (method === 'paypal') {
        document.getElementById('paypal-form').style.display = 'block';
    } else if (method === 'nequi') {
        document.getElementById('nequi-form').style.display = 'block';
    } else if (method === 'daviplata') {
        document.getElementById('daviplata-form').style.display = 'block';
    } else if (method === 'consignacion') {
        document.getElementById('consignacion-form').style.display = 'block';
    }
}

function redirectToPayPal() {
    const amount = document.getElementById('cantidad').value;
    const url = `https://www.paypal.com/donate?business=TU_CORREO_PAYPAL@EJEMPLO.COM&currency_code=COP&amount=${amount}&item_name=Donación para CaringPeople&no_shipping=1&return=https://tusitio.com/gracias.html&cancel_return=https://tusitio.com/cancelado.html`;
    window.location.href = url;
}

function generateQR(method) {
    const amount = document.getElementById('cantidad').value;
    const randomCode = Math.random().toString(36).substring(2, 15); // Generar código aleatorio
    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${randomCode}&size=150x150`;
    
    if (method === 'nequi') {
        $('#qr-container-nequi').html(`<img src="${qrUrl}" alt="Código QR para Nequi"><p>Escanea este código para donar $${amount} COP con Nequi.</p>`);
        $('#qr-container-nequi').show();
        showSuccessBanner();
    } else if (method === 'daviplata') {
        $('#qr-container-daviplata').html(`<img src="${qrUrl}" alt="Código QR para Daviplata"><p>Escanea este código para donar $${amount} COP con Daviplata.</p>`);
        $('#qr-container-daviplata').show();
        showSuccessBanner();
    }
}

function redirectToConsignacion() {
    const randomAccountNumber = Math.floor(Math.random() * 1000000000).toString().padStart(10, '0');
    alert(`Realiza tu consignación a la cuenta Bancolombia: ${randomAccountNumber}`);
    showSuccessBanner();
}

// Muestra el banner de éxito al completar la donación
function showSuccessBanner() {
    const banner = document.getElementById('success-banner');
    banner.style.display = 'block';
}
