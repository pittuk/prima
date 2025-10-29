# Proyecto PRIMA - Sitio Web Oficial

## Transformando residuos en oportunidades

Sitio web completo del primer laboratorio de innovación en residuos con enfoque territorial y comunitario de Chile.

---

## Estructura del Proyecto

```
PROYECTO PRIMA/
│
├── 📄 index.html                      # Home: Hero, servicios, impacto, testimonios, proyectos destacados
├── 📄 metodo-prima-home.html          # Método PRIMA: Infografía, pasos visuales, formulario
├── 📄 cultura-ambiental.html          # Cultura Ambiental: Curso, tips, banners educativos
├── 📄 equipo-prima.html               # Equipo: Fotos profesionales, biografías, video del equipo
├── 📄 contacto.html                   # Contacto: Formulario, mapa, redes sociales
│
├── 🎨 styles.css                      # CSS optimizado (30 KB - reducción del 54%)
├── 🎨 styles-backup.css               # Backup de estilos anteriores
│
├── 📁 images/                         # Carpeta principal de imágenes
│   ├── logo.png                       # Logo PRIMA
│   ├── hero-bg.jpg                    # Fondo hero principal
│   ├── hero-manos-mejorada.png        # Imagen de manos (hero)
│   ├── banner-principal.png           # Banner institucional
│   ├── manos.png                      # Imagen de manos en acción
│   ├── producto-manos-*.png           # Productos con manos (3 versiones)
│   ├── contact-background.png         # Fondo de contacto
│   ├── impacto.jpg                    # Imagen de impacto
│   ├── servicios.jpg                  # Imagen de servicios
│   ├── quienes-somos.jpg              # Imagen quiénes somos
│   ├── corfo-logo.png                 # Logo CORFO
│   ├── gobierno-chile-logo.png        # Logo Gobierno de Chile
│   │
│   ├── 📁 testimonios/                # [PENDIENTE] Fotos de testimonios
│   │   ├── testimonios-1.png          # María González
│   │   ├── testimonios-2.png          # Carlos Sepúlveda
│   │   └── testimonios-3.png          # Rosa Muñoz
│   │
│   ├── 📁 proyectos/                  # [PENDIENTE] Casos de éxito
│   │   ├── proyectos-destacados-1.png # Red Salud
│   │   ├── proyectos-destacados-2.png # Talleres Comunitarios
│   │   └── proyectos-destacados-3.png # Productos Innovadores
│   │
│   ├── 📁 equipo/                     # [PENDIENTE] Fotos del equipo
│   │   ├── equipo-grupal.png          # Foto grupal
│   │   └── miembro-*.png              # Retratos individuales
│   │
│   ├── 📁 aliados/                    # [PENDIENTE] Logos de aliados
│   │   └── aliados-logos.png          # Grid de logos
│   │
│   ├── 📁 infografias/                # [PENDIENTE] Infografías educativas
│   │   ├── metodo-prima-infografia.png
│   │   └── tips-ambientales-*.png
│   │
│   └── 📁 banners/                    # [PENDIENTE] Banners educativos
│       ├── banner-reciclaje.png
│       ├── banner-economia-circular.png
│       ├── banner-separacion.png
│       └── banner-impacto.png
│
├── 📁 videos/                         # [PENDIENTE] Videos institucionales
│   ├── equipo-en-accion.mp4           # Video del equipo en talleres
│   ├── caso-redsalud.mp4              # Caso de éxito Red Salud
│   └── usuarios-testimonios-*.mp4     # Clips testimoniales
│
├── 📄 PROMPTS_IMAGENES_VIDEOS.md      # Prompts para generar imágenes/videos con IA
├── 📄 README.md                       # Este archivo
│
├── 📁 .git/                           # Control de versiones Git
└── 📁 .claude/                        # Configuración Claude Code
```

---

## Páginas del Sitio

### 1. **Home** (`index.html`)
Página principal con:
- Hero visual atractivo con imagen de manos y productos
- Sección "¿Qué es PRIMA?"
- Servicios principales (Gestión, Educación, Desarrollo)
- Metodología en 5 pasos
- Triple impacto (Social, Económico, Ambiental)
- Apoyadores (CORFO, Gobierno, UDD Ventures)
- **NUEVO:** Testimonios con fotos reales
- **NUEVO:** Proyectos destacados con videos
- Impacto en números
- Footer completo con redes sociales

### 2. **Método PRIMA** (`metodo-prima-home.html`)
- Explicación detallada del método
- Infografía visual del proceso
- 5 etapas con pasos visuales
- Formulario de contacto
- Casos de aplicación

### 3. **Cultura Ambiental** (`cultura-ambiental.html`)
- Información del curso online
- Beneficios del microaprendizaje
- Contenidos del curso
- **NUEVO:** Blog con tips visuales
- **NUEVO:** Banners educativos
- Extensión para empresas
- Acceso al curso

### 4. **Equipo PRIMA** (`equipo-prima.html`)
- **NUEVO:** Foto grupal del equipo
- **NUEVO:** Biografías con fotos profesionales
- **NUEVO:** Video del equipo en acción
- Valores y misión del equipo

### 5. **Contacto** (`contacto.html`)
- Formulario de contacto mejorado
- **NUEVO:** Mapa interactivo de ubicación
- **NUEVO:** Integración de redes sociales
- Información de contacto
- Ubicación: Calle Andes N° 504, San Fabián, Ñuble

---

## Características Técnicas

### Diseño
- ✅ **Responsive Design:** Compatible con móviles, tablets y desktop
- ✅ **Paleta de Colores PRIMA:**
  - Verde bosque: `#2E7D32`
  - Verde suave: `#A5D6A7` / `#94BE4E`
  - Arena clara: `#F2EDE4`
  - Azul institucional: `#007BA0`
  - Naranja acento: `#FFA726` / `#FDB813`

### Tipografías
- **Inter:** Para cuerpo de texto (300, 400, 500, 600, 700, 800, 900)
- **Outfit:** Para títulos y encabezados (400, 500, 600, 700, 800, 900)

### Optimización
- CSS optimizado: **reducción del 54%** (de 67 KB a 30 KB)
- Imágenes con lazy loading
- Código limpio y estructurado
- Accesibilidad mejorada

---

## Imágenes y Videos Pendientes

### 🎯 Alta Prioridad
1. **Testimonios con fotos** (3 imágenes)
   - Ver prompts 31-33 en `PROMPTS_IMAGENES_VIDEOS.md`

2. **Proyectos destacados** (3 imágenes + 1 video)
   - Ver prompts 34-36 en `PROMPTS_IMAGENES_VIDEOS.md`

3. **Equipo PRIMA** (1 foto grupal + retratos individuales)
   - Ver prompts 38-39 en `PROMPTS_IMAGENES_VIDEOS.md`

### 📊 Prioridad Media
4. **Videos institucionales** (3 videos)
   - Equipo en acción
   - Caso Red Salud
   - Testimonios usuarios

5. **Infografías educativas**
   - Método PRIMA completo
   - Tips ambientales para blog

### 🎨 Prioridad Baja
6. **Banners educativos** (4 imágenes)
7. **Logos de aliados** (1 grid de logos)
8. **Mapa de ubicación** (1 ilustración)

**Todos los prompts detallados están disponibles en:** `PROMPTS_IMAGENES_VIDEOS.md`

---

## Cómo Usar este Proyecto

### Instalación y Ejecución Local

#### Opción 1: Servidor HTTP con Python
```bash
# Navegar a la carpeta del proyecto
cd "C:\Users\gonza\Desktop\PROYECTO PRIMA"

# Iniciar servidor local
python -m http.server 8000

# Abrir en navegador
# http://localhost:8000
```

#### Opción 2: Visual Studio Code Live Server
1. Abrir carpeta en VS Code
2. Instalar extensión "Live Server"
3. Click derecho en `index.html` → "Open with Live Server"

#### Opción 3: Cualquier servidor web
- Compatible con Apache, Nginx, etc.
- Solo archivos estáticos (HTML, CSS, JS, imágenes)

---

## Estructura de Navegación

```
Home (index.html)
│
├── Método PRIMA (metodo-prima-home.html)
├── Cultura Ambiental (cultura-ambiental.html)
├── Equipo PRIMA (equipo-prima.html)
└── Contacto (contacto.html)
```

Todas las páginas tienen navegación completa entre sí.

---

## Historial de Cambios

### Versión 2.0 (Octubre 2025) - ACTUAL
- ✅ Estructura mejorada con carpetas organizadas
- ✅ Sección de testimonios con fotos
- ✅ Proyectos destacados con videos
- ✅ Espacios preparados para nuevas imágenes
- ✅ Documentación completa de prompts para IA
- ✅ README actualizado
- 📁 Carpeta `/videos/` creada
- 📋 46 prompts profesionales documentados

### Versión 1.5 (Octubre 2025)
- ✅ Optimización masiva del CSS (54% reducción)
- ✅ Mejoras de legibilidad y contraste
- ✅ Sistema de navegación completo

### Versión 1.0 (Octubre 2025)
- ✅ Sitio web completo de 5 páginas
- ✅ Diseño profesional con tipografías Inter y Outfit
- ✅ Responsive design
- ✅ Formularios optimizados

---

## Próximos Pasos

### Fase 1: Contenido Visual
- [ ] Generar imágenes de testimonios (prompts 31-33)
- [ ] Crear imágenes de proyectos destacados (prompts 34-36)
- [ ] Fotografiar equipo PRIMA (prompt 38-39)

### Fase 2: Material Audiovisual
- [ ] Grabar video "Equipo en acción" (prompt 42)
- [ ] Producir video caso Red Salud (prompt 43)
- [ ] Recopilar testimonios en video

### Fase 3: Material Educativo
- [ ] Diseñar infografía Método PRIMA (prompt 41)
- [ ] Crear banners educativos (prompt 45)
- [ ] Desarrollar tips visuales para blog (prompt 44)

### Fase 4: Integraciones
- [ ] Integrar Google Maps en página de contacto
- [ ] Conectar formularios con backend/email
- [ ] Implementar analytics
- [ ] SEO optimization

---

## Tecnologías Utilizadas

- **HTML5:** Estructura semántica
- **CSS3:** Estilos avanzados, flexbox, grid
- **JavaScript Vanilla:** Animaciones y funcionalidades
- **Google Fonts:** Inter, Outfit
- **SVG:** Iconos escalables
- **Git:** Control de versiones

---

## Contacto y Soporte

**Proyecto PRIMA**
- 📍 Ubicación: Calle Andes N° 504, San Fabián - Ñuble, Chile
- 🌐 Sitio web: http://localhost:8000 (local)
- 📧 Email: [Pendiente agregar]
- 📱 WhatsApp: [Pendiente agregar]

---

## Licencia

© 2025 PRIMA. Todos los derechos reservados.

Proyecto apoyado por:
- CORFO
- Gobierno de Chile
- UDD Ventures

---

## Notas para Desarrolladores

### Estructura CSS
El archivo `styles.css` está organizado en bloques:
1. Variables y reset
2. Header y navegación
3. Hero sections
4. Secciones de contenido
5. Cards y componentes
6. Footer
7. Utilidades y responsive

### Añadir Nuevas Imágenes
1. Colocar imágenes en la carpeta correspondiente dentro de `/images/`
2. Usar nombres descriptivos (ej: `testimonios-1.png`)
3. Optimizar imágenes antes de subirlas (WebP recomendado)
4. Actualizar rutas en HTML según corresponda

### Convenciones de Nombres
- Archivos HTML: `nombre-pagina.html`
- Imágenes: `categoria-descripcion-numero.extension`
- Videos: `tipo-nombre-descriptivo.mp4`
- CSS classes: `kebab-case-class-name`

---

**Última actualización:** 27 de Octubre, 2025
**Mantenido por:** Equipo PRIMA + Claude Code
