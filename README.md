<h1>Exchange App</h1>

<p>Exchange App is a web application built with Laravel that allows users to exchange currencies.</p>

<h2>Requirements</h2>

<ul>
  <li>PHP >= 7.3</li>
  <li>Laravel >= 8.0</li>
  <li>MySQL >= 5.7</li>
</ul>

<h2>Installation</h2>

<ol>
  <li>Clone the repository: <code>git clone https://github.com/laza944/exchange-app.git</code></li>
  <li>Install dependencies: <code>composer install</code></li>
  <li>Create a new database and add your database credentials to your .env file</li>
  <li>In .env file please put your smtp.mailtrap.io credentials and APILAYER_CURRENCY_KEY</li>
  <li>Run the migrations: <code>php artisan migrate</code></li>
  <li>Run the schedule: <code>php artisan schedule:run</code></li>
  <li>Start the server: <code>php artisan serve</code></li>
</ol>

<h2>Usage</h2>

<ol>
  <li>Select the currencies you want to exchange and the amount</li>
  <li>Review and confirm the exchange</li>
</ol>

<h2>Contributions</h2>

<p>If you have any suggestions or find any bugs, please create an issue or submit a pull request.</p>

<h2>License</h2>

<p>Exchange App is open-source software licensed under the MIT license.</p>
