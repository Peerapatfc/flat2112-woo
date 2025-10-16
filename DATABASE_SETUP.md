# Database Setup Guide for WordPress on Render

## The Issue
Render's managed databases use PostgreSQL, but WordPress requires MySQL/MariaDB. This guide shows you how to set up an external MySQL database for your WordPress site.

## Recommended MySQL Providers

### Option 1: PlanetScale (Recommended - Free Tier Available)
1. Go to [PlanetScale](https://planetscale.com/)
2. Sign up for a free account
3. Create a new database
4. Get connection details from the dashboard
5. Use the connection details in Render environment variables

### Option 2: Railway
1. Go to [Railway](https://railway.app/)
2. Sign up and create a new project
3. Add a MySQL service
4. Get connection details from the dashboard

### Option 3: Aiven
1. Go to [Aiven](https://aiven.io/)
2. Sign up for a free trial
3. Create a MySQL service
4. Get connection details

## Setting Up Environment Variables in Render

1. Go to your Render dashboard
2. Navigate to your WordPress service
3. Go to Environment tab
4. Add these environment variables:

```
DATABASE_HOST=your-mysql-host.com
DATABASE_PASSWORD=your-mysql-password
DATABASE_USER=your-mysql-username
DATABASE_NAME=wordpress
DATABASE_PORT=3306
```

## Example with PlanetScale

1. **Create PlanetScale Database:**
   - Database name: `flat2112-wordpress`
   - Region: Choose closest to your Render region

2. **Get Connection Details:**
   - Host: `aws.connect.psdb.cloud`
   - Username: Generated username
   - Password: Generated password
   - Database: Your database name

3. **Set in Render:**
   ```
   DATABASE_HOST=aws.connect.psdb.cloud
   DATABASE_USER=your-planetscale-username
   DATABASE_PASSWORD=your-planetscale-password
   DATABASE_NAME=flat2112-wordpress
   DATABASE_PORT=3306
   ```

## Testing the Connection

After setting up the environment variables:

1. Redeploy your Render service
2. Check the logs for any connection errors
3. Visit your WordPress site
4. You should see the WordPress installation screen instead of database connection error

## Troubleshooting

### Connection Timeout
- Make sure your MySQL provider allows connections from Render's IP ranges
- Check if SSL is required and configure accordingly

### Authentication Issues
- Verify username and password are correct
- Some providers require specific authentication methods

### SSL Requirements
If your MySQL provider requires SSL, add this to wp-config.php:
```php
define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
```

## Alternative: Local Development

For local development, you can still use the docker-compose.yml file which includes a MySQL container:

```bash
docker-compose up -d
```

This will start WordPress with a local MySQL database on `http://localhost:8080`.