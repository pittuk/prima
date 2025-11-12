# Guía de Despliegue en Hostinger - Proyecto PRIMA

## Archivos del Proyecto

### Páginas HTML (7 archivos)
- index.html (Página principal)
- nosotros.html (Sobre PRIMA y equipo)
- metodo-prima-home.html (Método PRIMA)
- cultura-ambiental.html (Cultura ambiental)
- contacto.html (Formulario de contacto)
- contacto-gracias.html (Página de confirmación)
- agenda.html (Agenda de eventos)

### Backend PHP (1 archivo)
- enviar-formulario.php (Manejador de formularios con SMTP)

### Estilos CSS (1 archivo principal)
- styles-clean.css (Hoja de estilos principal - v6)

### Carpetas necesarias
- images/ (Imágenes y recursos visuales)
- videos/ (Videos del sitio)
- phpmailer/ (Librería PHPMailer para envío SMTP)

## Pasos para Desplegar en Hostinger

### 1. Preparación de Archivos
- [x] Verificar que todos los formularios usen enviar-formulario.php
- [x] Confirmar que todas las rutas sean relativas
- [ ] Comprimir imágenes si es necesario para optimizar carga

### 2. Configuración del Servidor (Hostinger)

#### A. Acceder al Panel de Control
1. Ingresar a hPanel de Hostinger
2. Ir a "Administrador de archivos" o usar FTP

#### B. Subir Archivos
1. Navegar a la carpeta `public_html/`
2. Subir todos los archivos .html
3. Subir enviar-formulario.php
4. Subir styles-clean.css
5. Crear carpeta `images/` y subir todas las imágenes
6. Crear carpeta `videos/` y subir todos los videos

### 3. Configurar el Correo Electrónico con SMTP ⚠️ IMPORTANTE

El sitio está configurado para usar **PHPMailer con SMTP de Hostinger** para evitar que los correos caigan en spam.

**Paso 1: Crear cuenta de correo en hPanel**
1. Ir a hPanel → "Correos electrónicos" → "Cuentas de correo"
2. Crear nueva cuenta:
   - Usuario: `info`
   - Dominio: `proyectoprima.com`
   - Contraseña: **Crear contraseña segura y guardarla**
   - Tamaño: Mínimo 1 GB

**Paso 2: Configurar credenciales SMTP**

Editar `enviar-formulario.php` líneas 6-12 con la contraseña creada:

```php
$smtp_host = 'smtp.hostinger.com';
$smtp_port = 465;
$smtp_user = 'info@proyectoprima.com';
$smtp_pass = 'TU_CONTRASEÑA_AQUI'; // ⚠️ CAMBIAR ESTO
$smtp_from = 'info@proyectoprima.com';
$smtp_from_name = 'Proyecto PRIMA';
$smtp_to = 'info@proyectoprima.com';
```

**Paso 3: Subir carpeta PHPMailer**

Asegurarse de subir la carpeta `phpmailer/` a la raíz de `public_html/`:

```
public_html/
├── enviar-formulario.php
├── phpmailer/
│   ├── Exception.php
│   ├── PHPMailer.php
│   └── SMTP.php
```

Ver **CONFIGURACION-SMTP.md** para detalles completos sobre configuración anti-spam.

### 5. Permisos de Archivos
Establecer permisos correctos:
- Archivos .html: 644
- enviar-formulario.php: 644
- Carpetas (images, videos): 755

### 6. Configurar Dominio

#### Si usas dominio personalizado:
1. En hPanel, ir a "Dominios"
2. Agregar dominio proyectoprima.com
3. Apuntar DNS a Hostinger:
   - Tipo A: IP del servidor Hostinger
   - Configurar registros en tu proveedor de dominio

#### Si usas subdominio de Hostinger:
- El sitio estará en: tudominio.hostinger.com

### 7. Pruebas Post-Despliegue

**Checklist de pruebas:**
- [ ] Navegar entre todas las páginas
- [ ] Verificar que todas las imágenes carguen correctamente
- [ ] Probar videos en metodo-prima-home.html
- [ ] Probar formulario en contacto.html
- [ ] Probar formulario en metodo-prima-home.html
- [ ] Verificar redirección a contacto-gracias.html
- [ ] Probar desde móvil y desktop
- [ ] Verificar menú hamburguesa en móvil
- [ ] Verificar botón flotante de WhatsApp
- [ ] Confirmar recepción de correos en info@proyectoprima.com

### 8. Optimizaciones Opcionales

**Performance:**
- Habilitar caché en Hostinger
- Comprimir CSS (minificar styles-clean.css)
- Optimizar imágenes (formato WebP)
- Habilitar compresión GZIP

**SEO:**
- Verificar meta tags en todas las páginas
- Enviar sitemap a Google Search Console
- Configurar Google Analytics (si aplica)
- Verificar SSL/HTTPS activo

**Seguridad:**
- Instalar certificado SSL (gratis en Hostinger)
- Agregar validación CAPTCHA a formularios (opcional)
- Configurar copias de seguridad automáticas

## Estructura de Archivos en Hostinger

```
public_html/
├── index.html
├── nosotros.html
├── metodo-prima-home.html
├── cultura-ambiental.html
├── contacto.html
├── contacto-gracias.html
├── agenda.html
├── enviar-formulario.php
├── styles-clean.css
├── .htaccess
├── phpmailer/
│   ├── Exception.php
│   ├── PHPMailer.php
│   ├── SMTP.php
│   └── [otros archivos]
├── images/
│   ├── logo.png
│   ├── Proyecto-prima-favicon.png
│   └── [todas las demás imágenes]
└── videos/
    └── [todos los videos]
```

## Solución de Problemas Comunes

### El formulario no envía correos
1. Verificar que la cuenta info@proyectoprima.com exista
2. Revisar logs de PHP en hPanel > "Logs de errores"
3. Considerar usar PHPMailer en lugar de mail()

### Las imágenes no cargan
1. Verificar que las rutas sean relativas (images/nombre.jpg)
2. Verificar permisos de carpeta images/ (755)
3. Confirmar que los nombres de archivo coincidan (sensible a mayúsculas)

### Error 500 en PHP
1. Revisar logs de error en hPanel
2. Verificar sintaxis de enviar-formulario.php
3. Confirmar versión de PHP (7.4+ recomendado)

### Estilos no se aplican
1. Limpiar caché del navegador (Ctrl+F5)
2. Verificar que styles-clean.css esté en la raíz
3. Revisar versión del CSS (?v=6) en las páginas HTML

## Contacto y Soporte

- Soporte Hostinger: https://www.hostinger.com/contact
- Documentación PHP Mail: https://www.php.net/manual/es/function.mail.php
- PHPMailer GitHub: https://github.com/PHPMailer/PHPMailer

## Notas Importantes

1. **Correo:** El formulario actual usa la función mail() de PHP. Hostinger a veces requiere configuración adicional para SMTP.
2. **SSL:** Asegúrate de activar SSL gratuito en Hostinger para HTTPS.
3. **Backups:** Configura copias de seguridad automáticas en hPanel.
4. **DNS:** Los cambios de DNS pueden tardar 24-48 horas en propagarse.

---

**Fecha de creación:** 12 de Noviembre de 2025
**Última actualización:** 12 de Noviembre de 2025
