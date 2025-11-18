FROM node:10 AS node-builder

WORKDIR /build
COPY . .

RUN npm install --global gulp-cli
RUN npm install &&  \
    npm run install &&  \
    gulp build

FROM php:7.4.33 AS php-builder

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git curl zip unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG ENVIRONMENT=production

WORKDIR /build
COPY --from=node-builder /build .

RUN composer install --no-interaction --optimize-autoloader
RUN php ./vendor/bin/tapestry.php build --env=${ENVIRONMENT}

FROM flashspys/nginx-static
RUN apk update && apk upgrade

# Re-declared so it can be used in this stage as well
ARG ENVIRONMENT=production
COPY --from=php-builder /build/build_${ENVIRONMENT} /static
