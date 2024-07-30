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

# Instalar dependencias
echo "Instalando dependencias..."
apt install -y curl wget git || error_exit "Error al instalar dependencias"

echo "Instalando git"
apt install -y git || error_exit "Error al instalar git"

echo "Instalando Python3 y venv"
apt install -y python3 python3-venv python3-pip || error_exit "Error al instalar Python3, venv y pip"

echo "Creando y activando entorno virtual"
python3 -m venv myprojectenv || error_exit "Error al crear el entorno virtual"
source myprojectenv/bin/activate || error_exit "Error al activar el entorno virtual"

echo "Instalando Flask"
pip install Flask || error_exit "Error al instalar Flask"
echo "Instalando libpango1.0-0..."
apt install libpango1.0-dev -y || error_exit "Error al instalar libpango1.0-0"

echo "Instalando dependencias de Flask"
pip install weasyprint || error_exit "Error al instalar weasyprint"
apt update || error_exit "Error al actualizar el sistema"
pip install flask-session || error_exit "Error al instalar flask-session"
pip install unidecode || error_exit "Error al instalar unidecode"

echo "Instalando PyMySQL..."
pip install PyMySQL || error_exit "Error al instalar PyMySQL"
echo "Instalación completada con éxito"

echo "Instalando MySQL Server"
apt install -y mysql-server || error_exit "Error al instalar MySQL Server"
echo "Instalación de MySQL Server completada"

echo "Instalando spaCy"
pip install spacy || error_exit "Error al instalar spaCy"
echo "Instalando nltk"
pip install nltk || error_exit "Error al instalar nltk"
echo "Descargando recursos de nltk"
python3 -c "import nltk; nltk.download('omw-1.4')" || error_exit "Error al descargar recursos de nltk"
#comando para descargar todos las librerias de nltk
#python3 -c "import nltk; nltk.download('all')" || error_exit "Error al descargar recursos de nltk"

python3 -m spacy download es_core_news_sm || error_exit "Error al descargar modelos de spaCy"

echo "Instalando numpy"
pip install numpy || error_exit "Error al instalar numpy"
echo "Instalar requests y beautifulsoup4"
pip install requests beautifulsoup4
echo "Descargando modelos de spaCy"
echo "Instalando sentence-transformers"
pip install sentence-transformers || error_exit "Error al instalar sentence-transformers"
echo "Instalación finalizada"
