<h1 align="center">Tapestry Website</h1>
<p align="center"><em>Source for Tapestry website and documentation</em></p>

<p align="center">
  <a href="LICENSE"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this repository
This is the source code repository for the documentation website [tapestry.cloud](https://www.tapestry.cloud). It provides documentation for the [Tapestry static site generator](https://github.com/tapestry-cloud/tapestry).

## Building the website locally
This project is quite old and uses an outdated version of PHP and Node having been built when Node v10 and PHP 7.4 were in use. As such I recommend using [Docker](https://www.docker.com/) to build the website locally.

If you still want to build the website locally, you'll need to install Node v10 and PHP v7.4 befoe running the following commands:

```bash
# Clone a local copy of this repository
git clone https://github.com/tapestry-cloud/tapestry-cloud-src.git

# Install PHP dependencies (for Tapestry) and node dependencies (for building assets)
composer install && yarn install

# Execute the build task with gulp
gulp build

# Use the basic http server built into PHP to serve the content of `build_local` to 127.0.0.1:3000
php -S 127.0.0.1:3000 -t build_local
```

## Building the website with Docker
In 2025, I added a `Dockerfile` to this project so that it can be built within a container and run locally. To build the image and run the container, run the following commands:

```bash
# Clone a local copy of this repository
git clone https://github.com/tapestry-cloud/tapestry-cloud-src.git

# Build the image
docker build -t tapestry-website .

# Run the container
docker run -it -p 80:3000 tapestry-website
```