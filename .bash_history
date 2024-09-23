ls
user
USER 
RUN chmod -R 755 /var/www
chmod -R 777 /var/www
ls -l /var/www/storage
chown -R www-data:www-data /var/www/storage
ls -l /var/www/storage
sudo chown -R www-data:www-data /var/www/storage
exit
