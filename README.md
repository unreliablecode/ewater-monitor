# Water Pump Monitoring System

This project is a simple web application that displays information about water pumps, including their status, pressure, and active/inactive state. The application fetches data from a MySQL database and dynamically generates the content using PHP and HTML.

## Features

- Displays a grid of pump details, including ID, status, pressure, and active/inactive state.
- Uses CSS for styling, with green and red boxes indicating pump status and activity.
- Implements pagination to navigate through pump records in the database.
- Retrieves data from a MySQL database using PHP and displays it on the web page.

## Prerequisites

Before running this application, ensure you have the following:

- A web server (e.g., Apache) with PHP support.
- A MySQL database with the necessary table (`maintable` in this case) and relevant data.

## Setup

1. Clone the repository to your web server's document root directory:

   ```bash
   git clone https://github.com/your-username/ewater-monitor.git
   ```

2. Create a MySQL database named `ewatermonitor`.

3. Import the necessary data into the database. You can find a sample SQL file in the repository (`database_dump.sql`).

4. Modify the database connection details in the PHP code:

   Open `index.php` and update the following lines with your database credentials:

   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_db_password";
   $dbname = "your_db_name";
   ```

5. Start your web server and access the application through a web browser.

## Usage

- Upon accessing the application, you'll see a grid of pump details.
- Pump status is indicated by green (Active) and red (Inactive) boxes.
- Pump pressure and status (Normal/ERROR) are displayed for each pump.
- Pagination links at the bottom allow you to navigate through pump records.

## Contributing

Contributions are welcome! If you find any issues or have suggestions, feel free to create an issue or pull request.

## License

This project is licensed under the [MIT License](LICENSE).

---

Feel free to customize this README according to your needs and add any additional sections or information that would be relevant to users of your project.
