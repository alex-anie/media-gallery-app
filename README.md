# Media Gallery

A Laravel-based media management application that allows users to sign in and manage uploaded documents. The app extracts and displays metadata from various media files including images, PDFs, videos, and audio files using Laravel FFmpeg.

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Vue.js (Laravel Vue Starter Kit)
- **Routing:** Wayfinder
- **Language:** TypeScript
- **Media Processing:** Laravel FFmpeg (by ProtoneMedia)

## Features

- User authentication and registration
- Upload multiple media file types (images, PDFs, videos, audio)
- Automatic metadata extraction from uploaded files
- Media gallery with file details and preview
- Responsive user interface

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP >= 8.1
- Composer
- Node.js >= 16.x and npm
- MySQL or PostgreSQL
- FFmpeg (required for media processing)

### Installing FFmpeg

**macOS:**

bash

```bash
brew install ffmpeg
```

**Ubuntu/Debian:**

bash

```bash
sudo apt update
sudo apt install ffmpeg
```

**Windows:** Download from [ffmpeg.org](https://ffmpeg.org/download.html) and add to your system PATH.

## Installation

### 1. Clone the Repository

bash

```bash
git clone https://github.com/alex-anie/media-gallery-app.git
cd media-gallery-app
```

### 2. Install PHP Dependencies

bash

```bash
composer install
```

### 3. Install JavaScript Dependencies

bash

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file and generate an application key:

bash

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file and configure your database connection:

env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=media_gallery
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Setup

Create your database, then run the migrations:

bash

```bash
php artisan migrate
```

If the application includes seeders:

bash

```bash
php artisan db:seed
```

### 6. Storage Link

Create a symbolic link for file storage:

bash

```bash
php artisan storage:link
```

## Running the Application

### Development Server

Start the Laravel development server:

bash

```bash
composer run dev
```

This will start the application at `http://localhost:8000` (or the configured port).

### Frontend Assets

In a separate terminal, compile and watch frontend assets:

bash

```bash
npm run dev
```

For production builds:

bash

```bash
npm run build
```

## Usage

1. Navigate to `http://localhost:8000` in your browser
2. Register a new account or log in
3. Upload media files (images, videos, audio, PDFs)
4. View extracted metadata and manage your media gallery

## Project Structure

```
media-gallery-app/
├── app/              # Application core code
├── config/           # Configuration files
├── database/         # Migrations and seeders
├── public/           # Public assets
├── resources/        # Views, Vue components, CSS
├── routes/           # Application routes
├── storage/          # File storage
└── tests/            # Test files
```

## Key Packages

- **Laravel FFmpeg** (ProtoneMedia): Provides fluent API for multimedia processing and metadata extraction
- **Laravel Vue Starter Kit**: Pre-configured Laravel and Vue.js integration
- **Wayfinder**: Type-safe routing for Laravel applications
- **TypeScript**: Static typing for improved development experience

## Troubleshooting

### FFmpeg not found

Ensure FFmpeg is installed and accessible in your system PATH. Test with:

bash

```bash
ffmpeg -version
```

### Storage permissions

If you encounter file upload issues:

bash

```bash
chmod -R 775 storage bootstrap/cache
```

### Database connection errors

Verify your `.env` database credentials and ensure your database server is running.

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the MIT license.

## Support

For issues and questions, please open an issue on the [GitHub repository](https://github.com/alex-anie/media-gallery-app/issues).
