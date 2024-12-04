#!/bin/bash

# Función para mostrar mensajes de error y salir
error_exit() {
    echo "$1" 1>&2
    exit 1
}

# Verificar si el script se está ejecutando como root
if [ "$(id -u)" != "0" ]; then
    error_exit "Ejecute con root"
fi

# Actualizar el sistema
echo "Actualizando el sistema..."
apt update || error_exit "Error al actualizar el sistema"
apt upgrade -y || error_exit "Error al actualizar los paquetes"

# Instalar git
echo "Instalando git"
apt install -y git || error_exit "Error al instalar git"

# Instalar MySQL Server
echo "Instalando MySQL Server"
apt install -y mysql-server || error_exit "Error al instalar MySQL Server"
echo "Instalación de MySQL Server completada"

# Instalar Apache2
echo "Instalando Apache2"
apt install apache2 || error_exit "Error al instalar Apache2"
echo "Instalación de Apache2 completada"

# Habilitar Apache2 para que se inicie automáticamente al arrancar
systemctl enable apache2 || error_exit "Error al habilitar Apache2"

# Iniciar el servicio de Apache2
systemctl start apache2 || error_exit "Error al iniciar Apache2"

# Verificar si Apache2 está funcionando correctamente
systemctl status apache2 || error_exit "Apache2 no se está ejecutando correctamente"

echo "Instalación y configuración de Apache2 completada"

echo "instalar php"
sudo apt install php php-cli php-fpm php-mysql php-xml php-mbstring php-curl php-zip php-json -y
