
    function cargarNotificaciones() {
        fetch('notificaciones.php')
            .then(response => response.json())
            .then(data => {
                const contenedor = document.getElementById('notificaciones');
                contenedor.innerHTML = ''; // Limpiar notificaciones anteriores

                if (data.length > 0) {
                    data.forEach(noti => {
                        const div = document.createElement('div');
                        div.style.cssText = "background: #007BFF; color: white; padding: 10px; margin-bottom: 10px; border-radius: 5px;";
                        div.innerHTML = `
                            <strong>Cita Próxima</strong>
                            <p><strong>Paciente:</strong> ${noti.paciente}</p>
                            <p><strong>Especialista:</strong> ${noti.especialista}</p>
                            <p><strong>Fecha:</strong> ${new Date(noti.fecha).toLocaleString()}</p>
                        `;
                        contenedor.appendChild(div);
                    });
                } else {
                    contenedor.innerHTML = '<p style="color: gray;">No hay notificaciones pendientes.</p>';
                }
            })
            .catch(error => console.error('Error al cargar notificaciones:', error));
    }

    // Cargar notificaciones cada 30 segundos
    setInterval(cargarNotificaciones, 30000);
    cargarNotificaciones(); // Cargar notificaciones al inicio

