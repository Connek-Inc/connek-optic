# Connek Optic 👓

Plataforma de gestión integral para óptica, desarrollada con **Laravel 11**, **Livewire 3**, y **Tailwind CSS**.

## 🚀 Características Principales

### 1. Gestión de Inventario Visual
- Catálogo de productos (monturas, lentes, accesorios) con imágenes y detalles técnicos.
- Grid responsivo de tarjetas con filtros y búsqueda.
- Control de stock y precios.

### 2. Nuevo Cliente (Wizard Paso a Paso)
- Flujo guiado para el registro de ventas y clientes.
- **Paso 1**: Datos personales con validación en tiempo real.
- **Paso 2**: Selección de categoría (Visión Sencilla, Progresivos, Niños, etc.).
- **Paso 3**: Selección de Promociones dinámicas.
- **Paso 4**: Ingreso de Prescripción (Manual o "Pendiente").
- **Paso 5-8**: Configuración de lentes (Material, Índice, Tratamientos).
- **Paso 9**: Resumen final y confirmación.

### 3. Internacionalización (i18n)
- Soporte completo para **Español 🇪🇸**, **Inglés 🇺🇸** y **Francés 🇫🇷**.
- Cambio de idioma dinámico vía sesión.

### 4. Gestión de Ventas y Facturación
- Historial de clientes y sus prescripciones.
- Envío de prescripciones por correo electrónico.
- Impresión de expedientes.

## 🛠️ Tecnologías

- **Framework**: Laravel 11
- **Frontend**: Livewire 3 + Blade
- **Estilos**: Tailwind CSS 4 + Flowbite
- **Base de Datos**: MySQL
- **Assets**: Vite

## ⚙️ Instalación Local

1.  **Clonar el repositorio**:
    ```bash
    git clone https://github.com/Connek-Inc/connek-optic.git
    cd connek-optic
    ```

2.  **Instalar dependencias PHP**:
    ```bash
    composer install
    ```

3.  **Instalar dependencias JS**:
    ```bash
    npm install
    ```

4.  **Configurar entorno**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configura tu base de datos en `.env`.*

5.  **Migraciones y Seeders**:
    ```bash
    php artisan migrate --seed
    ```

6.  **Iniciar servidor**:
    ```bash
    npm run dev
    # En otra terminal:
    php artisan serve
    ```

## 🚢 Despliegue (Hostinger / Shared Hosting)

El proyecto está configurado para desplegarse fácilmente.

### Despliegue Automático (Webhook)
Configura un Webhook en GitHub apuntando a:
`https://connekoptic.ca/deploy.php?key=ChangeThisSecretKey`
Esto actualizará el servidor automáticamente al hacer push.

### Despliegue Manual (SSH)
1.  Conectar por SSH:
    ```bash
    ssh -p 65002 u240244275@82.25.87.121
    ```
2.  Navegar y actualizar:
    ```bash
    cd domains/connekoptic.ca/public_html
    git pull origin main
    ```
3.  Construir (Build):
    ```bash
    npm install
    npm run build
    ```
    *(Nota: Si falla por memoria, el proyecto ya está configurado para intentar usar solo 512MB).*

## 📄 Licencia
Privada - Connek Inc.
