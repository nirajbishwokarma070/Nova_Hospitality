# Nova Hospitality

A five-section, responsive Laravel and Blade website for Nova Hospitality. The gallery imagery is illustrative and does not depict Nova Hospitality properties.

## Local development

1. Install PHP/Composer and Node.js/npm.
2. Copy `.env.example` to `.env` and run `composer install`.
3. Generate an application key with `php artisan key:generate`.
4. Install frontend dependencies with `npm install`.
5. In separate terminals, run `npm run dev` and `php artisan serve`.
6. Visit `http://127.0.0.1:8000`.

Run the feature tests with `php artisan test`.

## Contact email

The contact form validates and emails messages to `sagarshrestha813@gmail.com`. The default local Laravel mailer is `log`, which writes mail to the application log instead of delivering it. Configure `MAIL_MAILER=smtp` and the SMTP host, port, credentials, scheme, and an authorized `MAIL_FROM_ADDRESS` in `.env` to deliver messages.
