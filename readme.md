# Silex API - Globe Project P2ME
This is the API for Globe Project P2ME. It is used in conjuction with P2ME CMS.

## Author
The author is Gabriel John Gagno of Stratpoint Technologies, Inc. You can email him at ggagno@stratpoint.com.

## Setup Instructions
### Prerequisites
* Composer
* MySQL
* PHP PDO for MySQL
* MySQL Database structure (Dump included in root/dump folder. Run structure-dump first, then data-dump last)

__NOTE:__ You can also run the Laravel migrations if P2ME CMS Is already set up. This way, there is no need
to run the MySQL dumps included*

### Setup
1. Run ```composer install``` to install all needed dependencies.
2. This software uses environments for easier configuration. Create a ```.env``` file
 to configure needed settings. Please refer to ```.env.example``` for the data needed to be filled up.

## Running the API
1. Ask for authentication using the POST request.
```
POST /authorize
grant_type client_credentials
client_id <32-bit string from database table oauth_clients>
client_secret <16-bit string from database table oauth_clients>
```
2. Copy the ```access_token```. When doing other transactions, use the access token as follows:
```
GET /foo
Authorization Bearer <access_token>
```
## Testing the API
Included here is a ```db.json``` file intended for the ```json-server``` package. Please install this package
using ```npm install --g json-server``` and running ```json-server --watch db.json```.

## Updating
If new releases are up, make sure to run ```composer update```
to be updated to the latest packages.