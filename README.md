# AutoTune Project Documentation

## Project Overview
AutoTune is an automotive management application designed to streamline user account management, vehicle tracking, service maintenance logging, diagnostics and tuning, audit logs, notifications, payments, and other user-centric features. This README provides guidance on project structure, usage notes, and contribution guidelines.

## Team Members

| Group Users      | Full Name         | UTC ID |
| ---------------- | ----------------- | ------ |
| nyiaware         | Nyia Ware         | VLX686 |
| uniquefeelings   | Tiara Mack        | FGG636 |
| Blanca12658      | Blanca Perez      | SQB886 |
| morrowchristian  | Christian Morrow  | ZYW477 |
| Derikatr         | Derika Rice       | LHQ571 |

## Project Structure

- **Back_End**: Contains server-side scripts, database models, controllers, routes, and SQL files for managing database operations.
- **Front_End**: Includes HTML, CSS, JavaScript, PHP files, and assets for the user interface and client-side functionality.
- **Database**: Houses database configuration files, migrations, and seed data.
- **Documentation**: Contains the README, API documentation, troubleshooting information, and contributing guidelines.
- **Tests**: Holds test cases for both front-end and back-end features.
- **Logs**: Contains access and error logs for debugging purposes.
- **Config**: Stores environment configuration files for database and application settings.

## Usage Notes

- Make sure to configure your SQL environment to support MySQL syntax.
- Ensure you have the necessary permissions to create databases and modify tables before executing any scripts.
- The command `DROP DATABASE IF EXISTS AutoTuneDB;` should be used with caution, as it will delete the database if it exists.

## Contribution Guidelines

When contributing to this project, please use the following template for file headers. This ensures consistency across the codebase, making it easier for the team to track contributions and understand the purpose of each file.

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

Please follow this template for all new and updated files. It ensures all team members provide detailed, consistent documentation, improving collaboration and project management.
