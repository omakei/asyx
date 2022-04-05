
# Backend Developer Challenge

ClickBus API service challenge for backend developer

## System Requirement

Docker must be installed on your machine.

## Setup local environment

You can clone the project using git clone command:

```bash
git clone https://github.com/omakei/asyx.git
```

after clone the project you can change directory to project directory and copy `.env` file
using copy command:

```bash
cp .env.example .env
```

Then you can install the dependence using this command:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

This repository uses [Laravel Sail](https://laravel.com/docs/9.x/sail) for the local docker environment. 
You can use the sail command by configuring a bash alias below.

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
Start docker containers

```bash
sail up -d
```

Generate app key and places inside the `.env` file

```bash
sail artisan key:generate
```

Run database migration

```bash
sail artisan migrate:fresh --seed
```
Now you can access the app via [http://localhost:8000](http://localhost:8000).

## Usage

### User registration (POST request)
You can register user to use the api through this endpoint:

```bash
127.0.0.1:8000/api/auth/register
```
#### Body form-data 

| Field     |      Value              | 
|---------- |:-----------------------:|
| name      | Michael Assey           |
| email     | omakei96@gmail.com      |
| password  | Pa$$w0rd                |

### Login user (POST request)
You can log in user to use the api through this endpoint:

```bash
127.0.0.1:8000/api/auth/login?email=omakei96@gmail.com&password=Pa$$w0rd
```
#### Body form-data 

| Field     |      Value              | 
|---------- |:-----------------------:|
| email     | omakei96@gmail.com      |
| password  | Pa$$w0rd                |

### List Places (GET request)
You can list places through this endpoint:

```bash
127.0.0.1:8000/api/places
```
#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |


### Get specific Place (GET request)
You can get specific place through this endpoint:
127.0.0.1:8000/api/places/{place_id} eg.

```bash
127.0.0.1:8000/api/places/10
```
#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |

### Filter places by name (GET request)
You can filter places by name through this endpoint:
127.0.0.1:8000/api/places?filter[name]=omakei eg.

```bash
127.0.0.1:8000/api/places?filter[name]=omakei
```
#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |

### Create a place with image upload (POST request)
You can create a place and upload image through this endpoint:

```bash
127.0.0.1:8000/api/places
```

#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |


#### Body form-data

#### NB: Image must be a base 64 encoded and submitted as string

| Field     |      Value              | 
|---------- |:-----------------------:|
| name      | omakei                  |
| city      | Dar es salaam           |
| state     | Tanzania                |
| image     | data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4R/ORXhpZgAASUkqAAgAA  |

### Edit a place with image upload (PUT request)
You can edit a place and upload image through this endpoint:

```bash
127.0.0.1:8000/api/places
```

#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |


#### Body form-data

#### NB: Image must be a base 64 encoded and submitted as string

| Field     |      Value              | 
|---------- |:-----------------------:|
| name      | omakei edited           |
| city      | Dar es salaam           |
| state     | Tanzania                |
| image     | data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4R/ORXhpZgAASUkqAAgAA  |

### Delete Place (DELETE request)
You can delete a place through this endpoint:
127.0.0.1:8000/api/places/{place_id} eg.

```bash
127.0.0.1:8000/api/places/10
```
#### Request Headers

| Field             |      Value                                            | 
|-------------------|:-----------------------------------------------------:|
| Authorization     | Bearer 2&#124;hLcPXwB0kBk4ymhysLAelYxSK0LPPI9puU4wcW3J     |

## Running Test
```bash
sail composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [omakei](https://github.com/omakei)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
