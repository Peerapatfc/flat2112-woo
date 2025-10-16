# 🐳 Docker Setup Guide for flat2112-woo

This guide will help you set up and run the WordPress site using Docker and Docker Compose.

## 📋 Prerequisites

- Docker Desktop installed and running
- Docker Compose (included with Docker Desktop)
- Git (for cloning the repository)

## 🚀 Quick Start

1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd flat2112-woo
   ```

2. **Configure environment variables:**
   ```bash
   cp .env.example .env
   ```
   
   Edit the `.env` file with your preferred settings:
   ```bash
   nano .env  # or use your preferred editor
   ```

3. **Generate WordPress security keys:**
   Visit https://api.wordpress.org/secret-key/1.1/salt/ and replace the placeholder values in your `.env` file.

4. **Start the services:**
   ```bash
   docker compose up -d
   ```

5. **Access your site:**
   - **WordPress:** http://localhost:8080
   - **phpMyAdmin:** http://localhost:8081

## 🏗️ Architecture

The Docker setup includes three services:

### 📊 Database (MySQL 8.0)
- **Container:** `flat2112_mysql`
- **Port:** 3306
- **Volume:** `db_data` (persistent storage)
- **Health checks:** Enabled

### 🌐 WordPress
- **Container:** `flat2112_wordpress`
- **Port:** 8080
- **Volume:** `wordpress_data` (persistent storage)
- **Custom theme:** Mounted from `./wp-content`
- **Health checks:** Enabled

### 🔧 phpMyAdmin
- **Container:** `flat2112_phpmyadmin`
- **Port:** 8081
- **Purpose:** Database management interface

## ⚙️ Configuration

### Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `DB_NAME` | `flat2112_wordpress` | Database name |
| `DB_USER` | `wordpress` | Database user |
| `DB_PASSWORD` | `wordpress_secure_password_2024` | Database password |
| `DB_ROOT_PASSWORD` | `root_secure_password_2024` | MySQL root password |
| `WP_PORT` | `8080` | WordPress port |
| `PMA_PORT` | `8081` | phpMyAdmin port |
| `WP_DEBUG` | `false` | WordPress debug mode |
| `WP_HOME` | `http://localhost:8080` | WordPress home URL |
| `WP_SITEURL` | `http://localhost:8080` | WordPress site URL |

### Security Keys

Generate unique security keys at: https://api.wordpress.org/secret-key/1.1/salt/

Replace these in your `.env` file:
- `AUTH_KEY`
- `SECURE_AUTH_KEY`
- `LOGGED_IN_KEY`
- `NONCE_KEY`
- `AUTH_SALT`
- `SECURE_AUTH_SALT`
- `LOGGED_IN_SALT`
- `NONCE_SALT`

## 🛠️ Common Commands

### Start services
```bash
docker compose up -d
```

### Stop services
```bash
docker compose down
```

### View logs
```bash
# All services
docker compose logs

# Specific service
docker compose logs wordpress
docker compose logs db
```

### Rebuild and restart
```bash
docker compose up --build -d
```

### Check service status
```bash
docker compose ps
```

### Access container shell
```bash
# WordPress container
docker compose exec wordpress bash

# MySQL container
docker compose exec db mysql -u root -p
```

## 📁 File Structure

```
flat2112-woo/
├── docker-compose.yml      # Docker Compose configuration
├── Dockerfile             # WordPress container definition
├── .env                   # Environment variables
├── .env.example          # Environment template
├── wp-config.php         # WordPress configuration
├── wp-content/           # Custom themes and plugins
│   └── themes/
│       └── flat2112/     # Custom theme
└── DOCKER_SETUP.md       # This file
```

## 🔧 Troubleshooting

### Port Conflicts
If ports 8080 or 8081 are already in use:

1. Edit `.env` file:
   ```bash
   WP_PORT=8090
   PMA_PORT=8091
   ```

2. Restart services:
   ```bash
   docker compose down
   docker compose up -d
   ```

### Database Connection Issues
1. Check if MySQL container is healthy:
   ```bash
   docker compose ps
   ```

2. View database logs:
   ```bash
   docker compose logs db
   ```

3. Reset database:
   ```bash
   docker compose down -v  # WARNING: This deletes all data
   docker compose up -d
   ```

### WordPress Installation
1. Visit http://localhost:8080
2. Follow the WordPress installation wizard
3. Use the database credentials from your `.env` file

### File Permissions
If you encounter permission issues:
```bash
docker compose exec wordpress chown -R www-data:www-data /var/www/html
```

## 🚀 Production Deployment

For production deployment:

1. **Update environment variables:**
   - Change all passwords
   - Set `WP_DEBUG=false`
   - Update `WP_HOME` and `WP_SITEURL` to your domain

2. **Use external database:**
   - Consider using a managed MySQL service
   - Update database connection in `.env`

3. **SSL/HTTPS:**
   - Add reverse proxy (nginx, Traefik)
   - Configure SSL certificates

4. **Backups:**
   - Set up automated database backups
   - Backup WordPress files regularly

## 📚 Additional Resources

- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [WordPress Docker Image](https://hub.docker.com/_/wordpress)
- [MySQL Docker Image](https://hub.docker.com/_/mysql)
- [phpMyAdmin Docker Image](https://hub.docker.com/r/phpmyadmin/phpmyadmin)

## 🆘 Support

If you encounter issues:

1. Check the logs: `docker compose logs`
2. Verify all containers are running: `docker compose ps`
3. Ensure ports are not in use by other applications
4. Check your `.env` file configuration

For more help, please open an issue in the repository.