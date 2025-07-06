FROM php:7.4-apache

# Install required packages and PHP MySQL extension
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    gcc \
    netcat \
    && docker-php-ext-install mysqli \
    && rm -rf /var/lib/apt/lists/*

# Create user and set up user flag
RUN useradd -m -p "$(openssl passwd -1 shellpass)" library-user \
    && echo "FLAG{user_flag_here}" > /home/library-user/user.txt \
    && chmod 644 /home/library-user/user.txt

# Set up web application
COPY app/ /var/www/html/
RUN mkdir -p /var/www/html/uploads \
    && chown www-data:www-data /var/www/html/uploads

# Set up SUID binary
COPY tools/magic_backup.c /tmp/
RUN gcc /tmp/magic_backup.c -o /usr/bin/magic_backup \
    && chown root:root /usr/bin/magic_backup \
    && chmod 4755 /usr/bin/magic_backup \
    && rm /tmp/magic_backup.c

# Create backups directory
RUN mkdir -p /backups \
    && chown root:root /backups

# Copy root flag
COPY root/root.txt /root/root.txt
RUN chmod 600 /root/root.txt
