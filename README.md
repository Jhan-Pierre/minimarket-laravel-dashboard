<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Antes de empezar

Requisitos para levantar el proyecto:

- PHP 8.2+
- Composer 2.7+
- Node.js v21.7.3+
- npm 10.5+

## Actualizar la terminal

```bash
sudo apt update
sudo apt upgrade
```

## Clonar repositorio de GitHub

```bash
git clone git@github.com:LuisLopez-developer/minimarket-laravel.git
```

Cuando termine de descargar el proyecto: 

1. ingrese a la carpeta del proyecto, use el siguiente comando en la terminal.
```bash
cd minimarket-laravel
```

2. Consecuentemente debe copiar el archivo **.env**

```bash
cp .env.example .env
```

En el archivo **.env** modificar lo siguiente:


3. Instalar las dependencias del proyecto con npm

```bash
npm install
```

4. Instalar las dependencias de composer

```bash
composer install
```

5. Después de ello, diríjase a la carpeta de su proyecto usando la terminal, y ejecute los siguientes comandos.

```bash
php artisan key:generate

php artisan migrate
```