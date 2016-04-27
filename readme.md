# Silex API - Globe Project P2ME
This is the API for Globe Project P2ME. It is used in conjuction with P2ME CMS.

## Author
The author is Gabriel John Gagno of Stratpoint Technologies, Inc. You can email him at ggagno@stratpoint.com.

## Setup Instructions
*__NOTE:__ These set of instructions assume that the database configuration
has been set up. An easy way to do this is run the migrations in P2ME API.*

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