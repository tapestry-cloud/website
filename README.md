# Tapestry.Cloud

This is the source code repository for the documentation website [tapestry.cloud](https://www.tapestry.cloud). It provides documentation for the [Tapestry static site generator](https://github.com/tapestry-cloud/tapestry).

# Installing

To install a copy locally run the following steps:
```
git clone https://github.com/tapestry-cloud/tapestry-cloud-src.git # Clone a local copy of this repository
composer install && yarn install # Install PHP dependencies (for Tapestry) and node dependencies (for building assets)
gulp build # Execute the build task with `gulp`
php -S 127.0.0.1:3000 -t build_local # Use the basic http server built into PHP to serve the content of `build_local` to 127.0.0.1:3000
```
