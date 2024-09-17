#!/bin/bash

# Actualizar repositorios
echo "Actualizando los repositorios..."
sudo apt update

# Instalar Apache2
echo "Instalando Apache2..."
sudo apt install -y apache2

# Instalar MySQL Server
echo "Instalando MySQL Server..."
sudo apt install -y mysql-server

# Iniciar y habilitar MySQL
echo "Iniciando MySQL..."
sudo systemctl start mysql
sudo systemctl enable mysql

# Instalar PHP y extensión MySQL para PHP
echo "Instalando PHP y las extensiones necesarias para MySQL..."
sudo apt install -y php libapache2-mod-php php-mysql

# Reiniciar Apache para aplicar los cambios
echo "Reiniciando Apache..."
sudo systemctl restart apache2

# Configuración final
echo "Configuración finalizada. Por favor verifica que tu sistema esté corriendo correctamente."

# Opción para crear un archivo de prueba PHP para verificar la conexión
read -p "¿Deseas crear un archivo de prueba PHP para verificar la conexión entre PHP y MySQL? (s/n): " confirm
if [[ "$confirm" == "s" ]]; then
    echo "Creando archivo test.php en /var/www/html..."
    sudo bash -c 'cat > /var/www/html/test.php << EOF
<?php
\$servername = "localhost";
\$username = "root";
\$password = "";

\$conn = new mysqli(\$servername, \$username, \$password);

if (\$conn->connect_error) {
    die("Conexión fallida: " . \$conn->connect_error);
}
echo "Conexión exitosa";
?>
EOF'
    echo "Archivo de prueba creado. Puedes acceder a él desde: http://localhost/test.php"
else
    echo "Archivo de prueba no creado."
fi

echo "Instalación completada con éxito."
