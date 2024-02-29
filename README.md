# wp-thespace-access-log-csv

This is a WordPress plugin that logs access to the website and exports it as a CSV file.

## Installation

1. Download the plugin files.
2. Upload them to your `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

The plugin automatically logs access to the website. The log includes the following information:

- Date and time of access
- Site address
- IP address of the visitor
- User agent of the visitor
- Request path

The log is saved as a CSV file at the location specified by the `THESPACE_ACCESS_LOG_CSV_PATH` constant.

## Files

- `README.md`: This file.
- `.gitignore`: Specifies intentionally untracked files to ignore.
- `index.php`: A placeholder file.
- `LICENSE`: The license for this plugin.
- `thespace-access-log-csv.php`: The main plugin file.

## License

This project is licensed under GPL2.

## Author

The Space
[https://www.thespacesm.com/](https://www.thespacesm.com/)