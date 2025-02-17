# Partir de l'image PHP avec Apache
FROM php:8.2-apache

# Mettre à jour et installer les dépendances nécessaires (libssl-dev pour SSL)
RUN apt update && apt install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installer l'extension MongoDB via PECL
RUN pecl uninstall mongodb \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Copier la configuration Apache personnalisée dans le conteneur
COPY ./docker/apache/default.conf /etc/apache2/sites-available/000-default.conf

# Copier ton code dans le conteneur
COPY . /var/www/crimelab/

# Exposer le port 80 pour accéder à l'application
EXPOSE 86

# Lancer Apache
CMD ["apache2-foreground"]
