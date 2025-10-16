# WordPress on Render

A sample WordPress website configured for deployment on Render.com with Docker.

## Features

- 🐳 Docker-based deployment
- 🔒 Environment variable configuration
- 🚀 Optimized for Render platform
- 📱 Responsive WordPress installation
- 🔧 Local development support

## Quick Deployment to Render

### Step 1: Set Up External MySQL Database
Since Render uses PostgreSQL but WordPress needs MySQL, you'll need an external MySQL database:

**Recommended: PlanetScale (Free Tier)**
1. Sign up at [PlanetScale](https://planetscale.com/)
2. Create a new database
3. Note the connection details (host, username, password)

**See [DATABASE_SETUP.md](DATABASE_SETUP.md) for detailed instructions**

### Step 2: Deploy to Render
1. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Initial WordPress setup"
   git push origin main
   ```

2. **Connect to Render:**
   - Go to [Render Dashboard](https://dashboard.render.com/)
   - Click "New" → "Blueprint"
   - Connect your GitHub repository
   - Render will automatically detect the `render.yaml` and set up your services

3. **Configure Environment Variables:**
   - In Render dashboard, go to your service → Environment
   - Add your MySQL database credentials:
     ```
     DATABASE_HOST=your-mysql-host
     DATABASE_USER=your-mysql-username
     DATABASE_PASSWORD=your-mysql-password
     DATABASE_NAME=wordpress
     ```

4. **Access your site:**
   - Once deployed, you'll get a URL like `https://your-app-name.onrender.com`
   - Complete the WordPress installation

## Local Development

### Prerequisites
- Docker and Docker Compose installed
- Git

### Setup

1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd flat2112-woo
   ```

2. **Start the development environment:**
   ```bash
   docker-compose up -d
   ```

3. **Access your local WordPress:**
   - Open http://localhost:8080
   - Complete the WordPress installation

4. **Stop the development environment:**
   ```bash
   docker-compose down
   ```

## Configuration

### Environment Variables

The following environment variables can be configured:

| Variable | Description | Default |
|----------|-------------|---------|
| `DATABASE_HOST` | Database host | localhost |
| `DATABASE_NAME` | Database name | wordpress |
| `DATABASE_USER` | Database user | wordpress |
| `DATABASE_PASSWORD` | Database password | password |
| `WP_DEBUG` | Enable WordPress debugging | false |
| `WP_MEMORY_LIMIT` | WordPress memory limit | 256M |
| `TABLE_PREFIX` | WordPress table prefix | wp_ |

### Security Keys

WordPress security keys are automatically generated during deployment. For manual configuration, visit:
https://api.wordpress.org/secret-key/1.1/salt/

## File Structure

```
flat2112-woo/
├── Dockerfile              # Docker configuration
├── docker-compose.yml      # Local development setup
├── wp-config.php          # WordPress configuration
├── render.yaml            # Render deployment configuration
├── wp-content/            # Custom themes and plugins (optional)
└── README.md              # This file
```

## Customization

### Adding Themes and Plugins

1. Create a `wp-content` directory
2. Add your custom themes to `wp-content/themes/`
3. Add your custom plugins to `wp-content/plugins/`
4. Rebuild and redeploy

### Database

The setup uses PostgreSQL on Render (included in render.yaml). For local development, it uses MySQL.

## Troubleshooting

### Common Issues

1. **Database Connection Error:**
   - Check environment variables
   - Ensure database service is running

2. **File Permissions:**
   - The Dockerfile sets proper permissions automatically

3. **Memory Issues:**
   - Increase `WP_MEMORY_LIMIT` environment variable

### Logs

- **Render:** Check logs in Render dashboard
- **Local:** Use `docker-compose logs wordpress`

## Support

For issues related to:
- **Render deployment:** Check [Render documentation](https://render.com/docs)
- **WordPress:** Visit [WordPress support](https://wordpress.org/support/)
- **Docker:** See [Docker documentation](https://docs.docker.com/)

## License

This project is open source and available under the [MIT License](LICENSE).