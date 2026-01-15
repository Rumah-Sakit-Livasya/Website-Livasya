# Security Configuration Guide

This document provides instructions for server-level security configurations that cannot be implemented directly in the Laravel application code.

## 1. Hide Server Version Information

Exposing server version information can help attackers identify known vulnerabilities in your server software. Follow the instructions below based on your web server.

### For Nginx

Edit your `nginx.conf` file (usually located at `/etc/nginx/nginx.conf`):

```nginx
http {
    # Hide Nginx version in error pages and Server header
    server_tokens off;

    # Additional security: hide server header completely (optional)
    more_clear_headers Server;
}
```

After making changes, test the configuration and reload Nginx:

```bash
sudo nginx -t
sudo systemctl reload nginx
```

### For Apache

Edit your Apache configuration file (usually `/etc/httpd/conf/httpd.conf` or `/etc/apache2/apache2.conf`):

```apache
# Hide Apache version and OS information
ServerTokens Prod
ServerSignature Off
```

After making changes, restart Apache:

```bash
# For CentOS/RHEL
sudo systemctl restart httpd

# For Ubuntu/Debian
sudo systemctl restart apache2
```

### Verification

Test that server version is hidden:

```bash
curl -I https://livasya.com/
```

The `Server` header should show minimal information (e.g., `nginx` instead of `nginx/1.18.0`).

---

## 2. DNSSEC Configuration

DNSSEC (Domain Name System Security Extensions) protects against DNS spoofing and cache poisoning attacks. This must be configured at your DNS provider level.

### Cloudflare

1. Log in to your Cloudflare dashboard
2. Select your domain (livasya.com)
3. Go to **DNS** → **Settings**
4. Scroll to **DNSSEC** section
5. Click **Enable DNSSEC**
6. Copy the DS record information
7. Add the DS record to your domain registrar

**Documentation**: https://developers.cloudflare.com/dns/dnssec/

### AWS Route 53

1. Open the Route 53 console
2. Select your hosted zone
3. Choose **DNSSEC signing**
4. Click **Enable DNSSEC signing**
5. Create a KSK (Key-Signing Key)
6. Add the DS record to your domain registrar

**Documentation**: https://docs.aws.amazon.com/Route53/latest/DeveloperGuide/dns-configuring-dnssec.html

### Google Cloud DNS

1. Go to the Cloud DNS page in Google Cloud Console
2. Select your DNS zone
3. Click **DNSSEC** tab
4. Click **Turn on DNSSEC**
5. Copy the DS records
6. Add them to your domain registrar

**Documentation**: https://cloud.google.com/dns/docs/dnssec

### Other DNS Providers

-   **Namecheap**: DNS → Advanced DNS → DNSSEC
-   **GoDaddy**: DNS Management → Settings → DNSSEC
-   **DigitalOcean**: Networking → Domains → Settings → DNSSEC

### Verification

After enabling DNSSEC, verify it's working:

```bash
# Using dig
dig livasya.com +dnssec

# Using online tools
# Visit: https://dnssec-analyzer.verisignlabs.com/
```

---

## 3. Bot Protection Services

Implement bot protection to prevent automated scraping and attacks.

### Cloudflare (Recommended)

Cloudflare provides free bot protection:

1. Sign up at https://www.cloudflare.com/
2. Add your domain
3. Update nameservers at your domain registrar
4. Enable **Bot Fight Mode** in Security → Bots
5. Configure **Rate Limiting** rules in Security → WAF

**Features**:

-   DDoS protection
-   Bot detection and blocking
-   Rate limiting
-   Web Application Firewall (WAF)

### AWS WAF

For applications hosted on AWS:

1. Create a Web ACL in AWS WAF
2. Add rate-based rules
3. Configure bot control managed rule group
4. Associate with CloudFront or ALB

**Documentation**: https://docs.aws.amazon.com/waf/

### Alternative Solutions

-   **Imperva (Incapsula)**: Enterprise-grade protection
-   **Akamai**: Advanced bot management
-   **Sucuri**: Website security platform
-   **reCAPTCHA v3**: Add to forms for human verification

---

## 4. SSL/TLS Certificate Configuration

Ensure your SSL certificate is properly configured for HSTS to work.

### Let's Encrypt (Free)

```bash
# Install Certbot
sudo apt-get install certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d livasya.com -d www.livasya.com

# Auto-renewal is configured automatically
```

### Verify SSL Configuration

Test your SSL setup:

-   Visit: https://www.ssllabs.com/ssltest/analyze.html?d=livasya.com
-   Target grade: **A or A+**

---

## 5. Firewall Configuration

Configure server firewall to allow only necessary ports.

### UFW (Ubuntu)

```bash
# Enable UFW
sudo ufw enable

# Allow SSH
sudo ufw allow 22/tcp

# Allow HTTP and HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Check status
sudo ufw status
```

### Firewalld (CentOS/RHEL)

```bash
# Start firewalld
sudo systemctl start firewalld
sudo systemctl enable firewalld

# Allow services
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --reload
```

---

## 6. Security Headers Verification

After deploying the Laravel application changes, verify all security headers:

```bash
curl -I https://livasya.com/
```

Expected headers:

-   `Strict-Transport-Security: max-age=31536000; includeSubDomains; preload`
-   `X-Frame-Options: SAMEORIGIN`
-   `X-Content-Type-Options: nosniff`
-   `X-XSS-Protection: 1; mode=block`
-   `Referrer-Policy: strict-origin-when-cross-origin`
-   `Permissions-Policy: camera=(), microphone=(), geolocation=()`
-   `Content-Security-Policy: default-src 'self'; ...`

---

## 7. Monitoring and Maintenance

### Log Monitoring

Monitor security-related logs:

```bash
# Nginx access logs
sudo tail -f /var/log/nginx/access.log

# Nginx error logs
sudo tail -f /var/log/nginx/error.log

# Laravel logs
tail -f storage/logs/laravel.log
```

### Security Scanning

Regularly scan your website:

-   **Security Headers**: https://securityheaders.com/
-   **SSL Test**: https://www.ssllabs.com/ssltest/
-   **Mozilla Observatory**: https://observatory.mozilla.org/

### Updates

Keep software updated:

```bash
# Update system packages
sudo apt update && sudo apt upgrade

# Update Composer dependencies
composer update

# Update npm packages
npm update
```

---

## Summary Checklist

-   [ ] Hide server version information (Nginx/Apache)
-   [ ] Enable DNSSEC at DNS provider
-   [ ] Configure bot protection (Cloudflare recommended)
-   [ ] Verify SSL/TLS certificate
-   [ ] Configure server firewall
-   [ ] Verify security headers are working
-   [ ] Set up log monitoring
-   [ ] Schedule regular security scans

---

## Support

For issues or questions:

-   Laravel Security: https://laravel.com/docs/security
-   OWASP Security Guide: https://owasp.org/
-   Mozilla Web Security: https://infosec.mozilla.org/guidelines/web_security
