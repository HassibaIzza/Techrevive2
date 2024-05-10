<br/>

## Table Of Contents

- [About The Project](#about-the-project)
- [Features](#features)
- [Demo Video](#demo_video)
- [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Contributing](#contributing)
  - [Creating A Pull Request](#creating-a-pull-request)
- [License](#license)

## About The Project

It is a backend system for an E-Commerce built with the Laravel framework, provides a simple and secure platform for online buying and selling. With features like user authentication, and product management.

## Features
- User authentication with different levels of access (admin, vendor)
- User login/signup using Google or creating an account
- Admin privileges for managing the entire system
- Vendor capabilities to manage their own shop
- CRUD operations for managing brands, coupons, products, categories, and subcategories
- Automatic coupon deactivation using events in MySQL ( No need to do it manually )

### Screenshots


<hr />



### Database Diagram












## Built With

* PHP
* Laravel
* MySql
* Ajax
* Composer

## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* install php 8 or above
* install apache2 ( or any local serve )
* install mysql
* install composer

### Installation

1. Clone the repo

```sh
```

2. Import the database file from the folder "SQL File"
3. Make your own copy of the .env file
```sh
    cp .env.example .env
 
    DB_DATABASE= your db name here
    DB_USERNAME= your db username
    DB_PASSWORD= your password 
```

4. Install dependecies

```sh
    composer install
```
5. Generate a key
```sh
    php artisan key:generate
```
6. Start Running
```sh
    php artisan serve
```

## Contributing

### Creating A Pull Request


