<h1 align="center">Tapestry Website</h1>
<p align="center"><em>Source for Tapestry website and documentation</em></p>

<p align="center">
  <a href="LICENSE"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this repository
This is the source code repository for the documentation website [tapestry.cloud](https://www.tapestry.cloud). It provides documentation for the [Tapestry static site generator](https://github.com/tapestry-cloud/tapestry).

## Installing
To install a copy locally run the following steps:

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
