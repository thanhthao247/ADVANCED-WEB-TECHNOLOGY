
## Run
```bash
# Generate self-signed certs
openssl req -x509 -newkey rsa:2048 -sha256 -nodes -days 365 \
  -keyout certs/server.key -out certs/server.crt \
  -subj "/CN=localhost"

docker compose up -d --build
```

- App: http://localhost:8080 (redirects to https://localhost:8443)
- HTTPS: https://localhost:8443
- Login: `admin@example.com` / `s3sam3`
- phpMyAdmin: http://localhost:8081 (root / root)

## Optional: Defuse Crypto
Replace `app/crypto/defuse-crypto.phar` with the real file from https://github.com/defuse/php-encryption/releases
Then:
```bash
docker compose exec app php /var/www/html/crypto/generate_key.php
```
Open `https://localhost:8443/crypto/demo.php` after login.
