# Use a mesma imagem base do PHP e Apache
FROM yiisoftware/yii2-php:7.4-apache

# Copie os arquivos do aplicativo para o diretório de trabalho do Apache
COPY . /app

# Permite que o Apache escreva em alguns diretórios (apenas para desenvolvimento)
RUN chown -R www-data:www-data /app
RUN chmod -R 755 /app/runtime /app/web/assets

# Porta exposta pelo Apache dentro do contêiner (a mesma porta usada na configuração do docker-compose.yml)
EXPOSE 80

# Comando padrão para iniciar o Apache (não precisa ser alterado)
CMD ["apache2-foreground"]