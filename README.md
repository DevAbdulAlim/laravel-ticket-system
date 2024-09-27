# Laravel Support Ticket System

This is a Laravel-based support ticket system using **Reverb** for real-time features. It provides functionality for both **admin** and **normal users** with real-time messaging and ticket management.

## Features

-   **Admin and Normal User Roles**:
    -   **Admins** can manage all tickets, update statuses, and oversee the system.
    -   **Normal users** can submit and track the status of their own tickets.
-   **Real-Time Messaging**:

    -   Integrated real-time communication for discussions between users and admins on support tickets.
    -   Powered by **Reverb** for fast and seamless messaging.

-   **Ticket Management**:

    -   Users can create, view, and check the status of their support tickets.
    -   Admins can update ticket statuses(open and closed tickets)

-   **Email Notifications**:
    -   Admin will receive email notifications on ticket creation by a user
    -   Users receive email updates when their ticket status changes.

## Prerequisites

Before running the system, ensure the following:

-   **PHP** >= 8.1
-   **Composer** (for PHP dependencies)
-   **Laravel** >= 11
-   **MySQL** or a supported database
-   **Node.js** & **npm** (for frontend assets)
-   **Git** (optional)
-   **Reverb** (installed and configured)
-   **SMTP Server** (for email notifications)

## Installation

1. **Clone the repository**:

```bash
git clone https://github.com/your-username/laravel-support-ticket-system.git
```

2. **Navigate to the project directory**:

```bash
cd laravel-support-ticket-system
```

3. **Install PHP dependencies via Composer**:

```bash
composer install
```

4. **Set up your environment file**:

-   Copy `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

-   Update the `.env` file with your database, Reverb, and mail configuration details (see below).

5. **Generate the application key**:

```bash
php artisan key:generate
```

6. **Run database migrations**:

```bash
php artisan migrate
```

7. **Install Node.js dependencies and compile frontend assets**:

```bash
npm install
npm run dev
```

8. **Start the Laravel development server**:

```bash
php artisan serve
```

9. **Start Reverb**:

```bash
php artisan reverb:start
```

10. **Process queue jobs**:

```bash
php artisan queue:work
```

Visit the app in your browser at `http://localhost:8000`.
admin url: http://localhost:8000/admin

**You must change the user role to `admin` in you database manually for admin user**

---

## .env Configuration

### Reverb Configuration

Add the Reverb API details to your `.env` file for real-time messaging and communication:

```dotenv
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=890995
REVERB_APP_KEY=w3r18oxsniy5ybcfaaih
REVERB_APP_SECRET=jdufkd4sib7ftucyrkw0
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

### Mail Configuration

To enable email notifications for ticket status changes and other actions, add your SMTP mail server credentials:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io    # Or your chosen mail service (Mailgun, SMTP, etc.)
MAIL_PORT=2525
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls           # Depending on your provider
MAIL_FROM_ADDRESS=admin@support-system.com
MAIL_FROM_NAME="Support System"
```
