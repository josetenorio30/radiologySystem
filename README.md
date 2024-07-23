Radiology System
Este proyecto es un sistema de radiología que permite gestionar estudios de radiología, registrar lecturas y generar informes. La aplicación está construida con Laravel y proporciona una arquitectura modular para manejar la autenticación de usuarios, CRM, ERP y un almacén de datos para informes de inteligencia empresarial (BI).

Requisitos Previos
Antes de comenzar, asegúrate de tener instalados los siguientes componentes:

PHP (versión 7.3 o superior)
Composer
Node.js y npm
MySQL (u otro servidor de base de datos)
Git (opcional, para clonar el repositorio)
Instalación
Sigue estos pasos para configurar y ejecutar el proyecto en tu máquina local:

Clonar el Repositorio
Si tienes Git instalado, clona el repositorio del proyecto. Si no, simplemente descarga el archivo ZIP del proyecto y extráelo en tu directorio de trabajo.

Clona el repositorio: git clone https://github.com/josetenorio30/radiologySystem.git
Navega al directorio del proyecto: cd radiologySystem
Instalar Dependencias
Dependencias de PHP
Instala las dependencias de PHP utilizando Composer:

composer install

Dependencias de Node.js
Instala las dependencias de Node.js utilizando npm:

npm install

Configurar el Archivo .env
Copia el archivo .env.example a .env y configúralo con tus credenciales de base de datos y otras configuraciones necesarias:

Copia el archivo: cp .env.example .env
Configura las variables en el archivo .env.
Generar la Clave de la Aplicación
Genera una clave de aplicación única:

php artisan key:generate

Migrar y Sembrar la Base de Datos
Ejecuta las migraciones para crear las tablas en la base de datos y luego ejecuta los seeders para poblar las tablas con datos de prueba:

php artisan migrate --seed

Compilar los Activos
Si estás utilizando Laravel Mix para compilar tus archivos CSS y JavaScript, ejecuta el siguiente comando:

npm run dev

Iniciar el Servidor de Desarrollo
Inicia el servidor de desarrollo de Laravel:

php artisan serve

El servidor estará disponible en http://localhost:8000
Usuarios de Prueba
El sistema viene preconfigurado con dos usuarios de prueba que se crean al ejecutar los seeders:
 Usuarios
Usuario 1

Email: user1@example.com
Contraseña: password

Usuario 2

Email: user2@example.com
Contraseña: password
