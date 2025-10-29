import re

# El nuevo footer minimalista
new_footer = '''    <!-- Footer Minimalista Moderno -->
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-modern-grid">
                <!-- Logo y Copyright -->
                <div class="footer-modern-brand">
                    <img src="images/logo.png" alt="PRIMA" class="footer-modern-logo">
                    <p class="footer-modern-copyright">©2025 Proyecto PRIMA.<br>Todos los derechos reservados.</p>
                </div>

                <!-- Servicios -->
                <div class="footer-modern-column">
                    <h4 class="footer-modern-title">Servicios</h4>
                    <ul class="footer-modern-list">
                        <li><a href="index.html#servicios">Gestión de Residuos</a></li>
                        <li><a href="metodo-prima-home.html">Método PRIMA</a></li>
                        <li><a href="cultura-ambiental.html">Capacitaciones</a></li>
                        <li><a href="#">Asesorías</a></li>
                    </ul>
                </div>

                <!-- Nosotros -->
                <div class="footer-modern-column">
                    <h4 class="footer-modern-title">Nosotros</h4>
                    <ul class="footer-modern-list">
                        <li><a href="index.html#quienes-somos">Sobre PRIMA</a></li>
                        <li><a href="equipo-prima.html">Equipo</a></li>
                        <li><a href="contacto.html">Contacto</a></li>
                        <li><a href="#">Proyectos</a></li>
                    </ul>
                </div>

                <!-- Recursos -->
                <div class="footer-modern-column">
                    <h4 class="footer-modern-title">Recursos</h4>
                    <ul class="footer-modern-list">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Centro de Ayuda</a></li>
                        <li><a href="#">Documentación</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div class="footer-modern-column">
                    <h4 class="footer-modern-title">Contáctanos</h4>
                    <p class="footer-modern-contact-text">¿Preguntas o comentarios?<br>Nos encantaría saber de ti.</p>
                    <div class="footer-modern-social">
                        <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>'''

files = ['contacto.html', 'metodo-prima-home.html', 'cultura-ambiental.html', 'equipo-prima.html']

for filename in files:
    try:
        with open(filename, 'r', encoding='utf-8') as f:
            content = f.read()

        # Buscar y reemplazar el footer (desde <footer hasta </footer>)
        pattern = r'<footer class="footer">.*?</footer>'
        new_content = re.sub(pattern, new_footer, content, flags=re.DOTALL)

        with open(filename, 'w', encoding='utf-8') as f:
            f.write(new_content)

        print(f"OK - {filename} actualizado")
    except Exception as e:
        print(f"ERROR - {filename}: {e}")

print("\nFooter actualizado en todos los archivos!")
