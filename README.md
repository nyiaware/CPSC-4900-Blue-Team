# AutoTune Project Documentation

## Project Overview
AutoTune is a web-based automotive management application that provides users with tools for managing vehicle information, tracking service history, and performing diagnostics. It features user account management, secure data handling, and a user-friendly interface, allowing efficient record-keeping and maintenance tracking for vehicles.

### Key Features
- **User Account Management**: Register, log in, and update user profiles.
- **Vehicle Information**: Add and view detailed vehicle information.
- **Service and Maintenance Logs**: Track the service history of each vehicle.
- **Data Retrieval and Submission**: Streamlined data entry and retrieval processes.
- **Role-Based Access**: Different access levels for users based on roles.

## Team Members
 
| Group Users      | Full Name         | UTC ID |
| ---------------- | ----------------- | ------ |
| nyiaware         | Nyia Ware         | VLX686 |
| trsmac           | Tiara Mack        | FGG636 |
| Blanca12658      | Blanca Perez      | SQB886 |
| morrowchristian  | Christian Morrow  | ZYW477 |
| Derikatr         | Derika Rice       | LHQ571 |

## Project Structure

- **Back_End**: Server-side scripts, database models, controllers, routes, and SQL files for managing database operations.
- **Front_End**: HTML, CSS, JavaScript, PHP files, and assets for the user interface and client-side functionality.
- **Database**: Configuration files, migrations, and seed data for database setup.
- **Documentation**: Contains this README, API documentation, troubleshooting information, and contributing guidelines.
- **Tests**: Test cases for both front-end and back-end features.
- **Logs**: Access and error logs for debugging purposes.
- **Config**: Environment configuration files for database and application settings.

## Installation and Setup

To set up the project, follow these steps:

1. **Clone the Repository**: Download the project files:
   ```bash
   git clone <repository-url>
   ```

2. **Database Setup**: Import the `AutoTuneDB_Schema.sql` file into your MySQL server to establish the database schema.

3. **Configure Database Connection**: Update `/Front_End/db_autotune.php` with your MySQL database credentials.

4. **Run the Application**: Open the project in a web server environment that supports PHP and MySQL (e.g., XAMPP, WAMP).

5. **Testing**: Test functionality by navigating to the login and registration pages, creating an account, and entering vehicle data to ensure smooth data entry and retrieval.

## Usage

- **User Login**: Log in with your credentials.
- **Add Vehicle Information**: Use the vehicle entry form to add vehicle details.
- **View Service History**: Check the service logs for maintenance records.
- **Manage Profile**: Update your profile details in the account settings.

## Usage Notes

- Configure your SQL environment to support MySQL syntax.
- Ensure you have permissions for database creation and modification before running any scripts.
- Be cautious with the command `DROP DATABASE IF EXISTS AutoTuneDB;` as it will delete the database if it already exists.

## Contribution Guidelines

If you’d like to contribute to the AutoTune project, please follow these steps:

1. **Fork the Repository**: Create your own copy.
2. **Create a New Branch**: Use a new branch for each feature or bug fix.
3. **Review and Test**: Ensure your code is reviewed and thoroughly tested.
4. **Submit a Pull Request**: To integrate your changes.

Please use the file header template below in all new and modified files to maintain documentation consistency across the codebase:

### File Header Template

```
/*******************************************************
 * File: [Filename]
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTune
 *
 * Description:
 * [Brief description of the file's purpose and contents, e.g., "This script sets up the structure for the user profile management features in AutoTune."]
 * 
 * Major Components:
 * - [Component 1]: [Brief description]
 * - [Component 2]: [Brief description]
 * - [Component 3]: [Brief description]
 *
 * Usage Notes:
 * - [Any specific requirements or prerequisites]
 * - [Important notes or warnings for users executing the file]
 *
 * Revision History:
 * - [Date]: [Description of changes made]
 * - [Date]: [Description of changes made]
 * 
 *******************************************************/
```

This template ensures detailed, consistent documentation, making collaboration and project management smoother for the entire team.
