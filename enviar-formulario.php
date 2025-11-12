<?php
// ============================================
// CONFIGURACIÓN SMTP HOSTINGER
// ============================================
// IMPORTANTE: Cambiar la contraseña después de crear el correo en hPanel
$smtp_host = 'smtp.hostinger.com';
$smtp_port = 465; // Puerto SSL
$smtp_user = 'info@proyectoprima.com';
$smtp_pass = 'TU_CONTRASEÑA_AQUI'; // ⚠️ CAMBIAR ESTO en Hostinger
$smtp_from = 'info@proyectoprima.com';
$smtp_from_name = 'Proyecto PRIMA';
$smtp_to = 'info@proyectoprima.com';

// Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

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
        $asunto = "Nuevo mensaje desde el sitio web de PRIMA - Solicitud Método PRIMA";
    } else {
        $asunto = "Nuevo mensaje desde el sitio web de PRIMA - " . $motivo_texto;
    }

    // Crear el cuerpo del mensaje HTML
    $mensaje_html = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #1B5E20; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .content { background-color: #f9f9f9; padding: 20px; border-radius: 0 0 8px 8px; }
            .field { margin-bottom: 15px; padding: 10px; background-color: white; border-radius: 4px; }
            .label { font-weight: bold; color: #1B5E20; display: block; margin-bottom: 5px; }
            .value { margin-top: 5px; color: #333; }
            .footer { margin-top: 20px; padding-top: 20px; border-top: 2px solid #1B5E20; font-size: 12px; color: #666; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2 style='margin: 0;'>Nuevo mensaje de contacto - PRIMA</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <span class='label'>Nombre completo:</span>
                    <span class='value'>{$nombre} {$apellido}</span>
                </div>

                <div class='field'>
                    <span class='label'>Email:</span>
                    <span class='value'>{$email}</span>
                </div>

                <div class='field'>
                    <span class='label'>Teléfono:</span>
                    <span class='value'>{$telefono}</span>
                </div>

                <div class='field'>
                    <span class='label'>Ubicación:</span>
                    <span class='value'>{$ciudad}, {$comuna}</span>
                </div>

                <div class='field'>
                    <span class='label'>Tipo de formulario:</span>
                    <span class='value'>{$tipo_formulario}</span>
                </div>";

    // Agregar campos específicos según el tipo de formulario
    if ($es_metodo_prima) {
        $experiencia_texto = ($experiencia == 'si') ? 'Sí, tengo experiencia' : 'No, pero me interesa aprender';
        $herramientas_texto = ($herramientas == 'si') ? 'Sí' : 'No';
        $funcionario_texto = ($funcionario == 'si') ? 'Sí' : 'No';

        $mensaje_html .= "
                <div class='field'>
                    <span class='label'>¿Tiene experiencia trabajando con residuos?</span>
                    <span class='value'>{$experiencia_texto}</span>
                </div>

                <div class='field'>
                    <span class='label'>¿Tiene experiencia usando herramientas manuales?</span>
                    <span class='value'>{$herramientas_texto}</span>
                </div>

                <div class='field'>
                    <span class='label'>¿Es funcionario municipal?</span>
                    <span class='value'>{$funcionario_texto}</span>
                </div>";
    } else {
        $mensaje_html .= "
                <div class='field'>
                    <span class='label'>Motivo del contacto:</span>
                    <span class='value'>{$motivo_texto}</span>
                </div>";
    }

    // Comentario (si existe)
    if (!empty($comentario)) {
        $mensaje_html .= "
                <div class='field'>
                    <span class='label'>Comentario:</span>
                    <span class='value'>" . nl2br(htmlspecialchars($comentario)) . "</span>
                </div>";
    }

    $mensaje_html .= "
                <div class='field'>
                    <span class='label'>Consentimiento:</span>
                    <span class='value'>{$consentimiento}</span>
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

    // ============================================
    // ENVIAR EMAIL CON PHPMAILER Y SMTP
    // ============================================

    try {
        // Crear instancia de PHPMailer
        $mail = new PHPMailer(true);

        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
        $mail->Port = $smtp_port;
        $mail->CharSet = 'UTF-8';

        // Configuración para evitar problemas de SSL en algunos servidores
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Remitente y destinatario
        $mail->setFrom($smtp_from, $smtp_from_name);
        $mail->addAddress($smtp_to);
        $mail->addReplyTo($email, $nombre . ' ' . $apellido);

        // Contenido del email
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje_html;

        // Versión de texto plano (fallback)
        $mail->AltBody = strip_tags(str_replace('<br>', "\n", $mensaje_html));

        // Enviar email
        $mail->send();

        // Éxito - redirigir a página de confirmación
        header("Location: contacto-gracias.html");
        exit;

    } catch (Exception $e) {
        // Error al enviar - registrar el error y redirigir
        error_log("Error al enviar email: {$mail->ErrorInfo}");

        $pagina_error = $es_metodo_prima ? "metodo-prima-home.html" : "contacto.html";
        header("Location: " . $pagina_error . "?error=" . urlencode("Hubo un error al enviar el mensaje. Por favor intenta nuevamente o contáctanos directamente por WhatsApp."));
        exit;
    }

} else {
    // Si no es POST, redirigir al formulario de contacto
    header("Location: contacto.html");
    exit;
}
?>
