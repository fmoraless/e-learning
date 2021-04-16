

## Web Uni

Web uni es una aplicación clon de udemy, para la gestión de cursos virtuales.
El sistema está realizado con el Framework Laravel y cuenta con las siguientes funcionalidades:

- Sección para que el profesor pueda dar alta a sus cursos y unidades.
- Sección para que el alumno pueda visualizar sus cursos.
- Gestion de pagos con Stripe.
- Envío de factura via email
- Valoraciones.
- Sección para debates.
- Carrito de compras.



## Instalación

- Clonar repositorio desde https://github.com/fmoraless/e-learning.git
- **composer update**



## Base de datos

- Crear Base de datos e-learning
  - **DB_CONNECTION=** 
  - **DB_HOST=**
  - **DB_PORT=**
  - **DB_DATABASE=** e-learning
  - **DB_USERNAME=** root
  - **DB_PASSWORD=**
- Correr las migraciones con **php artisan migrate --seed**

## Stripe

- Configuración cuenta de Stripe (.env file).
    - **STRIPE_KEY=**
    - **STRIPE_SECRET=**
    - **STRIPE_WEBHOOK_SECRET=**
    - **STRIPE_TAXES=**
    - **CASHIER_CURRENCY=**
    - **CASHIER_CURRENCY_LOCALE=**
    - **CASHIER_MODEL=**

## Mailtrap

- Configuración cuenta de Mailtrap (.env file).
  
  - **MAIL_MAILER=**
  - **MAIL_HOST=**
  - **MAIL_PORT=**
  - **MAIL_USERNAME=**
  - **MAIL_PASSWORD=**
  - **MAIL_ENCRYPTION=**
  - **MAIL_FROM_ADDRESS=**
  - **MAIL_FROM_NAME=**"${APP_NAME}"


## License

The Web-uni is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
