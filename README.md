<h2>MyTechnology Laravel Test</h2>
1. composer Install Command

2. npm install

3. Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env

4. Generate a new application key

php artisan key:generate


5. Start the local development server

php artisan serve

6. Run the database migrations (Set the database connection in .env before migrating)
   php artisan migrate

#Unit Testing

Run Command php artisan test

it will test the api of create Product Success Response
