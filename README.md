# flat2112-woo

A WordPress site for flat2112 with WooCommerce integration.

## 🚀 Quick Start

### Option 1: Docker (Recommended for Local Development)

The easiest way to get started is using Docker:

```bash
# Clone the repository
git clone <your-repo-url>
cd flat2112-woo

# Copy environment file
cp .env.example .env

# Start the services
docker compose up -d

# Access your site
open http://localhost:8080
```

**What you get:**
- WordPress at http://localhost:8080
- phpMyAdmin at http://localhost:8081
- MySQL database with persistent storage
- Your custom theme pre-loaded

For detailed Docker setup instructions, see [DOCKER_SETUP.md](DOCKER_SETUP.md).

### Option 2: Render.com Deployment

For production deployment on Render.com, you'll need an external MySQL database since Render uses PostgreSQL.

**Recommended: PlanetScale (Free Tier Available)**

1. Sign up at [PlanetScale](https://planetscale.com/)
2. Create a new database named `flat2112-wordpress`
3. Configure environment variables in Render dashboard

For detailed Render setup instructions, see [DATABASE_SETUP.md](DATABASE_SETUP.md).

## 📁 Project Structure

```
flat2112-woo/
├── docker-compose.yml         # Docker Compose configuration
├── Dockerfile                 # WordPress container definition
├── .env.example              # Environment variables template
├── wp-config.php             # WordPress configuration
├── wp-content/               # Custom themes and plugins
│   └── themes/
│       └── flat2112/         # Custom theme
├── render.yaml              # Render deployment config
├── DOCKER_SETUP.md          # Docker setup guide
├── DATABASE_SETUP.md        # Database setup guide
└── README.md                # This file
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