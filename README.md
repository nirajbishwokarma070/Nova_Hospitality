# Nova Hospitality

A six-section, responsive Laravel and Blade website for Nova Hospitality. Illustrative photographs are not Nova Hospitality properties. Homepage copy and images can be updated through the protected admin panel; image credits are listed below the gallery.

The standalone Rooms page currently shows proposed room categories. Rates, services, amenities, and availability are explicitly marked as unconfirmed until Nova Hospitality supplies verified details.

## Local development

1. Install PHP/Composer and Node.js/npm.
2. Copy `.env.example` to `.env` and run `composer install`.
3. Generate an application key with `php artisan key:generate`.
4. Configure SQLite or MySQL in `.env`, then run `php artisan migrate`.
5. Link public image storage with `php artisan storage:link`.
6. Create the first admin account with `php artisan admin:create`. The command prompts for credentials; no default password is provided.
7. Install frontend dependencies with `npm install`.
8. In separate terminals, run `npm run dev` and `php artisan serve`.
9. Visit `http://127.0.0.1:8000`; sign in at `/admin/login`.

Run the feature tests with `php artisan test`.

The admin panel edits homepage text, image descriptions, and image uploads. Uploaded images are limited to JPG, PNG, or WebP files up to 5 MB. Admin accounts are created only from the command line.

## Contact email

The contact form validates and emails messages to `sagarshrestha813@gmail.com`. The default local Laravel mailer is `log`, which writes mail to the application log instead of delivering it. Configure `MAIL_MAILER=smtp` and the SMTP host, port, credentials, scheme, and an authorized `MAIL_FROM_ADDRESS` in `.env` to deliver messages.
