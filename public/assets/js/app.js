document.querySelectorAll('form[action*="route=cancel"]').forEach(form=>form.addEventListener('submit',event=>{if(!confirm('¿Deseas cancelar esta reserva?'))event.preventDefault();}));
