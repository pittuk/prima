# Configuración SMTP para Hostinger - Proyecto PRIMA

## Problema: Correos caen en SPAM

Los correos enviados con la función `mail()` de PHP suelen caer en spam porque no tienen autenticación SMTP adecuada. La solución es usar **PHPMailer con SMTP de Hostinger**.

## Solución Implementada

Se actualizó `enviar-formulario.php` para usar **PHPMailer con SMTP autenticado** de Hostinger, lo cual:

✓ Evita que los correos caigan en spam
✓ Mejora la entregabilidad
✓ Permite autenticación segura
✓ Proporciona mejor manejo de errores

## Pasos para Configurar en Hostinger

### 1. Crear Cuenta de Correo en hPanel

1. Ingresar a **hPanel de Hostinger**
2. Ir a **"Correos electrónicos"** → **"Cuentas de correo"**
3. Hacer clic en **"Crear cuenta de correo"**
4. Configurar:
   - **Usuario:** `info`
   - **Dominio:** `proyectoprima.com`
   - **Contraseña:** Crear una contraseña segura (guárdala)
   - **Tamaño del buzón:** Mínimo 1 GB

5. Hacer clic en **"Crear"**

### 2. Obtener Credenciales SMTP

Las credenciales SMTP de Hostinger son:

```
Host: smtp.hostinger.com
Puerto: 465 (SSL) o 587 (TLS)
Usuario: info@proyectoprima.com
Contraseña: [La que creaste en el paso 1]
```

### 3. Configurar enviar-formulario.php

**IMPORTANTE:** Editar el archivo `enviar-formulario.php` en las líneas 7-12:

```php
$smtp_host = 'smtp.hostinger.com';
$smtp_port = 465;
$smtp_user = 'info@proyectoprima.com';
$smtp_pass = 'TU_CONTRASEÑA_AQUI'; // ⚠️ CAMBIAR ESTO
$smtp_from = 'info@proyectoprima.com';
$smtp_from_name = 'Proyecto PRIMA';
$smtp_to = 'info@proyectoprima.com';
```

**Reemplazar `TU_CONTRASEÑA_AQUI`** con la contraseña que creaste en el paso 1.

### 4. Subir Archivos a Hostinger

Subir estos archivos/carpetas a `public_html/`:

```
public_html/
├── enviar-formulario.php (actualizado con SMTP)
├── phpmailer/
│   ├── Exception.php
│   ├── PHPMailer.php
│   ├── SMTP.php
│   └── [otros archivos de PHPMailer]
```

**IMPORTANTE:** La carpeta `phpmailer/` debe estar en la raíz junto con `enviar-formulario.php`.

### 5. Verificar Permisos

Establecer permisos correctos:
- `enviar-formulario.php`: 644
- Carpeta `phpmailer/`: 755
- Archivos dentro de `phpmailer/`: 644

### 6. Probar el Formulario

1. Ir a tu sitio: `https://proyectoprima.com/contacto.html`
2. Completar el formulario de contacto
3. Hacer clic en "Enviar Mensaje"
4. Verificar que llegue el correo a `info@proyectoprima.com`
5. **Revisar bandeja de entrada** (no debería estar en spam)

## Verificación Adicional Anti-SPAM

Para mejorar aún más la entregabilidad:

### 1. Configurar SPF (Sender Policy Framework)

En hPanel → **DNS/Zone Editor** → Agregar registro TXT:

```
Tipo: TXT
Nombre: @
Valor: v=spf1 include:_spf.hostinger.com ~all
TTL: 14400
```

### 2. Configurar DKIM (DomainKeys Identified Mail)

Hostinger generalmente configura DKIM automáticamente. Verificar en:
- hPanel → **Correos electrónicos** → **Autenticación de correo**
- Activar **DKIM** si no está activo

### 3. Configurar DMARC (opcional pero recomendado)

Agregar registro TXT:

```
Tipo: TXT
Nombre: _dmarc
Valor: v=DMARC1; p=none; rua=mailto:info@proyectoprima.com
TTL: 14400
```

## Solución de Problemas

### El formulario no envía correos

**Problema:** Error al enviar el formulario

**Soluciones:**
1. Verificar que la contraseña en `enviar-formulario.php` sea correcta
2. Verificar que la carpeta `phpmailer/` esté en la raíz
3. Revisar logs de error en hPanel → **Archivos** → **Logs de errores**

### Los correos aún caen en spam

**Soluciones:**
1. Configurar SPF, DKIM y DMARC (ver arriba)
2. Esperar 24-48 horas para propagación de DNS
3. Pedir a los destinatarios que marquen como "No es spam"
4. Verificar que el dominio no esté en listas negras: https://mxtoolbox.com/blacklists.aspx

### Error de conexión SSL

**Problema:** "Could not connect to SMTP host"

**Soluciones:**
1. Cambiar puerto de 465 a 587
2. Cambiar `ENCRYPTION_SMTPS` a `ENCRYPTION_STARTTLS`
3. Verificar que el firewall del servidor permita conexiones SMTP

### Correos no llegan

**Soluciones:**
1. Verificar logs de correo en hPanel
2. Probar enviar correo manual desde hPanel (Webmail)
3. Verificar cuota de correo (no esté lleno)

## Comparación: mail() vs PHPMailer SMTP

| Característica | mail() | PHPMailer SMTP |
|----------------|--------|----------------|
| Configuración | Simple | Requiere credenciales |
| Autenticación | No | Sí ✓ |
| Cae en spam | Frecuentemente ⚠️ | Raramente ✓ |
| Entregabilidad | Baja | Alta ✓ |
| Manejo errores | Limitado | Detallado ✓ |
| Seguridad | Básica | Alta (SSL/TLS) ✓ |

## Archivos Incluidos

```
prima-master/
├── enviar-formulario.php (actualizado con PHPMailer)
├── phpmailer/
│   ├── Exception.php
│   ├── PHPMailer.php
│   ├── SMTP.php
│   ├── POP3.php
│   └── [otros archivos]
├── CONFIGURACION-SMTP.md (este archivo)
└── DESPLIEGUE-HOSTINGER.md (guía de despliegue)
```

## Ejemplo Real de Configuración

Este es un ejemplo de otro proyecto funcionando en Hostinger:

```php
// Proyecto AeroFactor (ejemplo funcional)
$smtp_host = 'smtp.hostinger.com';
$smtp_port = 465;
$smtp_user = 'info@aerofactorlatam.com';
$smtp_pass = 'fA2isYH/z!(n9w5';
$smtp_from = 'info@aerofactorlatam.com';
$smtp_to = 'info@aerofactorlatam.com';
```

Para PRIMA será igual, solo cambia el dominio:

```php
// Proyecto PRIMA
$smtp_host = 'smtp.hostinger.com';
$smtp_port = 465;
$smtp_user = 'info@proyectoprima.com';
$smtp_pass = '[TU_CONTRASEÑA]'; // La que creaste en hPanel
$smtp_from = 'info@proyectoprima.com';
$smtp_to = 'info@proyectoprima.com';
```

## Recursos Adicionales

- **Documentación PHPMailer:** https://github.com/PHPMailer/PHPMailer
- **Guía SMTP Hostinger:** https://support.hostinger.com/en/articles/1583298-how-to-use-smtp
- **Test de SPAM:** https://www.mail-tester.com/
- **Verificar DNS:** https://mxtoolbox.com/

## Contacto y Soporte

- **Soporte Hostinger:** https://www.hostinger.com/contact
- **Documentación Hostinger:** https://support.hostinger.com/

---

**Fecha de creación:** 12 de Noviembre de 2025
**Última actualización:** 12 de Noviembre de 2025
