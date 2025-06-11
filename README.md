# Aplicación de Inventario

Esta es una aplicación web desarrollada con Laravel y Tailwind CSS para la gestión de inventarios. Permite administrar categorías, productos y generar reportes. Está pensada para facilitar el control y la organización de los artículos dentro de un sistema de inventario.

## Funcionalidades principales

- Autenticación de usuarios
- CRUD de categorías
- CRUD de productos
- Generación de reportes
- Exportación de datos (Excel)
- Interfaz responsive y moderna con Tailwind CSS

## Tecnologías utilizadas

- PHP 8+
- Laravel 10+
- MySQL
- Tailwind CSS
- Blade (motor de plantillas de Laravel)
- JavaScript

## Módulos de la aplicación

### Categorías
- Crear, listar, editar y eliminar categorías

### Productos
- Crear, listar, editar y eliminar productos
- Asociación de productos a una categoría
- Control de stock, precios y descripción

### Reportes
- Generación de reportes 
- Exportación de reportes en formatos  Excel

## Requisitos previos

- PHP >= 8.1
- Composer
- Node.js y npm
- Servidor MySQL
- Laravel instalado globalmente (opcional)

## Instalación y configuración

1.Instalar las dependencias de PHP:
composer install

2.Instalar dependencias de JavaScript y compilar los assets con Tailwind CSS:
npm install
npm install tailwindcss @tailwindcss/vite
npm run dev

3.Generar la clave de la aplicación:
php artisan key:generate

4. Ejecutar migraciones para crear las tablas:
php artisan migrate

5. Iniciar el servidor:
php artisan serve



## Clonar el repositorio:

```bash
git clone https://github.com/IVANUTP/Inventario.git
