## Plataforma de Votación y Encuestas

## Descripción

Este proyecto es un sistema de votación y encuestas diseñado para procesos electorales en Bolivia. Garantiza seguridad, transparencia y auditoría a través de tecnologías como hash, verificación de ubicación, verificación de identidad y prevención de votos fraudulentos.

## Requisitos del sistema

- Cada persona tiene derecho a un solo voto.
- Solo pueden votar personas reales (no bots).
- Solo bolivianos pueden participar.
- Sistema auditable y de código abierto.
- Prevención de alteración de datos.
- Implementación de:
  - Formulario con preguntas de validación para bolivianos.
  - ReCaptcha.
  - Captura de ubicación.
  - Usuario y contraseña para consulta del voto.
  - Hash de comprobación para detectar alteraciones.
  - Hash anti alteraciones.

## Tecnologías utilizadas

El proyecto está desarrollado con **Laravel 9**, utilizando las siguientes dependencias:

- **PHP 8.2**
- **Laravel Framework 9.52.20**
- **NoCaptcha** para validación anti-bots
- **IPFS API** para almacenamiento descentralizado
- **Doctrine ORM, DBAL y Eloquent** para la base de datos
- **GuzzleHTTP** para peticiones HTTP
- **Laravel Sanctum** para autenticación de usuarios
- **Symfony Cache** para optimización de caché

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/mrmustard123/nombre-repositorio.git
   cd nombre-repositorio
   ```
2. Instalar dependencias:
   ```bash
   composer install
   ```
3. Configurar el entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configurar la base de datos en el archivo `.env`.
5. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```
6. Iniciar el servidor:
   ```bash
   php artisan serve
   ```

## Uso

- Los usuarios deben registrarse con datos verificados.
- El sistema permite la selección de candidatos en elecciones activas.
- Se registra la ubicación e IP del votante para auditoría.
- Los resultados se pueden consultar de manera transparente.

## Seguridad y Auditoría

- Los votos se almacenan con hashes para detectar alteraciones.
- Se verifica la identidad con preguntas específicas para bolivianos.
- La auditoría de votos es accesible públicamente sin revelar datos personales.

## Contribución

Este proyecto es de código abierto y está en constante mejora.


