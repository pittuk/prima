<?php
// Configuración del destinatario
$destinatario = "info@proyectoprima.com"; // Cambia esto por el email de PRIMA
$asunto_base = "Nuevo mensaje desde el sitio web de PRIMA";

// Validar que el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitizar y validar los datos del formulario
    $nombre = isset($_POST['nombre']) ? trim(strip_tags($_POST['nombre'])) : '';
    $apellido = isset($_POST['apellido']) ? trim(strip_tags($_POST['apellido'])) : '';
    $telefono = isset($_POST['telefono']) ? trim(strip_tags($_POST['telefono'])) : '';
    $email = isset($_POST['email']) ? trim(strip_tags($_POST['email'])) : '';
    $ciudad = isset($_POST['ciudad']) ? trim(strip_tags($_POST['ciudad'])) : '';
    $comuna = isset($_POST['comuna']) ? trim(strip_tags($_POST['comuna'])) : '';
    $motivo = isset($_POST['motivo']) ? trim(strip_tags($_POST['motivo'])) : '';
    $comentario = isset($_POST['comentario']) ? trim(strip_tags($_POST['comentario'])) : '';
    $consentimiento = isset($_POST['consentimiento']) ? 'Sí' : 'No';
    $tipo_formulario = isset($_POST['tipo_formulario']) ? trim(strip_tags($_POST['tipo_formulario'])) : 'Contacto General';

    // Campos específicos del formulario de Método PRIMA
    $experiencia = isset($_POST['experiencia']) ? trim(strip_tags($_POST['experiencia'])) : '';
    $herramientas = isset($_POST['herramientas']) ? trim(strip_tags($_POST['herramientas'])) : '';
    $funcionario = isset($_POST['funcionario']) ? trim(strip_tags($_POST['funcionario'])) : '';

    // Determinar de qué página viene el formulario
    $es_metodo_prima = ($tipo_formulario == 'Método PRIMA');

    // Validar campos obligatorios
    $errores = [];

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }

    if (empty($apellido)) {
        $errores[] = "El apellido es obligatorio";
    }

    if (empty($telefono)) {
        $errores[] = "El teléfono es obligatorio";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email es obligatorio y debe ser válido";
    }

    if (empty($ciudad)) {
        $errores[] = "La ciudad es obligatoria";
    }

    if (empty($comuna)) {
        $errores[] = "La comuna es obligatoria";
    }

    // El comentario solo es obligatorio en el formulario de contacto general
    if (!$es_metodo_prima && empty($comentario)) {
        $errores[] = "El comentario es obligatorio";
    }

    if (!isset($_POST['consentimiento'])) {
        $errores[] = "Debes dar tu consentimiento para continuar";
    }

    // Si hay errores, redirigir con mensaje de error a la página correspondiente
    if (count($errores) > 0) {
        $mensaje_error = implode(", ", $errores);
        $pagina_error = $es_metodo_prima ? "metodo-prima-home.html" : "contacto.html";
        header("Location: " . $pagina_error . "?error=" . urlencode($mensaje_error));
        exit;
    }

    // Traducir el motivo a texto legible
    $motivos_texto = [
        'metodo-prima' => 'Quiero emprender con residuos (Método PRIMA)',
        'cultura-ambiental' => 'Me interesa el curso de Cultura Ambiental',
        'empresa' => 'Pertenezco a una Empresa',
        'municipio' => 'Representante de municipio'
    ];

    $motivo_texto = isset($motivos_texto[$motivo]) ? $motivos_texto[$motivo] : $motivo;

    // Crear el asunto del email según el tipo de formulario
    if ($es_metodo_prima) {
        $asunto = $asunto_base . " - Solicitud Método PRIMA";
    } else {
        $asunto = $asunto_base . " - " . $motivo_texto;
    }

    // Crear el cuerpo del mensaje
    $mensaje = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #1B5E20; color: white; padding: 20px; text-align: center; }
            .content { background-color: #f9f9f9; padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #1B5E20; }
            .value { margin-top: 5px; }
            .footer { margin-top: 20px; padding-top: 20px; border-top: 2px solid #1B5E20; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Nuevo mensaje de contacto - PRIMA</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Nombre completo:</div>
                    <div class='value'>{$nombre} {$apellido}</div>
                </div>

                <div class='field'>
                    <div class='label'>Email:</div>
                    <div class='value'>{$email}</div>
                </div>

                <div class='field'>
                    <div class='label'>Teléfono:</div>
                    <div class='value'>{$telefono}</div>
                </div>

                <div class='field'>
                    <div class='label'>Ubicación:</div>
                    <div class='value'>{$ciudad}, {$comuna}</div>
                </div>

                <div class='field'>
                    <div class='label'>Tipo de formulario:</div>
                    <div class='value'>{$tipo_formulario}</div>
                </div>";

    // Agregar campos específicos según el tipo de formulario
    if ($es_metodo_prima) {
        $experiencia_texto = ($experiencia == 'si') ? 'Sí, tengo experiencia' : 'No, pero me interesa aprender';
        $herramientas_texto = ($herramientas == 'si') ? 'Sí' : 'No';
        $funcionario_texto = ($funcionario == 'si') ? 'Sí' : 'No';

        $mensaje .= "
                <div class='field'>
                    <div class='label'>¿Tiene experiencia trabajando con residuos?</div>
                    <div class='value'>{$experiencia_texto}</div>
                </div>

                <div class='field'>
                    <div class='label'>¿Tiene experiencia usando herramientas manuales?</div>
                    <div class='value'>{$herramientas_texto}</div>
                </div>

                <div class='field'>
                    <div class='label'>¿Es funcionario municipal?</div>
                    <div class='value'>{$funcionario_texto}</div>
                </div>";
    } else {
        $mensaje .= "
                <div class='field'>
                    <div class='label'>Motivo del contacto:</div>
                    <div class='value'>{$motivo_texto}</div>
                </div>";
    }

    // Comentario (si existe)
    if (!empty($comentario)) {
        $mensaje .= "
                <div class='field'>
                    <div class='label'>Comentario:</div>
                    <div class='value'>{$comentario}</div>
                </div>";
    }

    $mensaje .= "

                <div class='field'>
                    <div class='label'>Consentimiento:</div>
                    <div class='value'>{$consentimiento}</div>
                </div>

                <div class='footer'>
                    <p>Este mensaje fue enviado desde el formulario de contacto del sitio web de Proyecto PRIMA.</p>
                    <p>Fecha: " . date('d/m/Y H:i:s') . "</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";

    // Configurar los headers del email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@proyectoprima.com" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Intentar enviar el email
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        // Éxito - redirigir a página de confirmación
        header("Location: contacto-gracias.html");
        exit;
    } else {
        // Error al enviar
        $pagina_error = $es_metodo_prima ? "metodo-prima-home.html" : "contacto.html";
        header("Location: " . $pagina_error . "?error=" . urlencode("Hubo un error al enviar el mensaje. Por favor intenta nuevamente."));
        exit;
    }

} else {
    // Si no es POST, redirigir al formulario de contacto
    header("Location: contacto.html");
    exit;
}
?>
