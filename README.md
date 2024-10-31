# Laravel Project Setup Guide

## **Initial Setup**

### **1. Clone the Repository**
- Find a location on your computer where you want to store the project. A directory made for projects is generally a good choice.
- Launch a bash console in that location and clone the project repository:

    ```bash
    git clone https://github.com/organization/project.git
    ```

### **2. Change Directory to the Project**
- You will need to be inside the project directory that was just created, so change into it:

    ```bash
    cd project_name
    ```

### **3. Install Composer Dependencies**
- After cloning a new Laravel project, install all project dependencies. This will include Laravel itself, along with other necessary packages:

    ```bash
    composer install
    ```

### **4. Install NPM Dependencies**
- Similarly to Composer, NPM manages JavaScript, CSS, and Node packages, so make sure to install those dependencies as well:

    ```bash
    npm install
    ```

### **5. Copy the .env File**
- The `.env` file is not usually committed to source control for security reasons, but there’s a template `.env.example` provided.
- Copy the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

### **6. Generate an App Encryption Key**
- Laravel requires an encryption key, which is usually generated randomly and stored in the `.env` file. This key is used to encode various elements of your application, from cookies to password hashes.
- Run the following command to generate the key:

    ```bash
    php artisan key:generate
    ```

### **7. Create an Empty Database for the Application**
- Using your preferred database management tool (such as phpMyAdmin, DataGrip, or any other MySQL client), create an empty database for your project.

### **8. Configure Database Connection in .env**
- To allow Laravel to connect to the database, fill in the necessary connection details in the `.env` file with the database credentials for the one you just created:

    ```plaintext
    DB_HOST=your_host
    DB_PORT=your_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

### **9. Branding and Name**
- You can customize the values for `MIX_APP_BRANDING` and `MIX_APP_NAME` in the `.env` file. If no branding is desired, you can leave `MIX_APP_BRANDING` as an empty string.

### **10. Migrate the Database**
- After configuring the database connection, run the migrations to create all necessary tables in your database:

    ```bash
    php artisan migrate
    ```

## **During Development**

### **Compiling Assets**
- To compile all Sass and JS assets using Webpack, run the following command:

    ```bash
    npm run dev
    ```

- Alternatively, you can use the following command to keep Webpack watching for changes in relevant files. It will automatically recompile assets when it detects changes:

    ```bash
    npm run watch
    ```

### **Local Development Server**
- To start a local development server, run the command below. This will initiate a server at `http://localhost:8000`:

    ```bash
    php artisan serve
    ```
