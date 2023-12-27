# Use an official PHP runtime as a parent image
FROM php:8.1-cli

# Set working directory
WORKDIR /usr/src/app

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Adding user for application (non-root)
RUN useradd -m appuser && chown -R appuser:appuser /usr/src/app
USER appuser

# Copy the application files
COPY --chown=appuser:appuser . .

# Install dependencies
RUN composer install

# Command to run the application
CMD [ "php", "./run.php" ]