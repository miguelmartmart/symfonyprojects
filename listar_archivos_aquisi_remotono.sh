#!/bin/bash

# Nos aseguramos de estar en la raíz del proyecto
cd "$(git rev-parse --show-toplevel)" || exit

# Aseguramos que la información remota esté actualizada
git fetch origin

echo "Archivos que existen localmente pero no en la rama remota origin/feature/citas:"
echo "--------------------------------------------------------------------------"

# Listado de archivos locales (excluyendo .git y ocultos del sistema)
find . -type f -not -path "./.git/*" -not -path "./.git" | sed 's|^\./||' | sort > local_files.txt

# Listado de archivos en la rama remota origin/feature/citas
git ls-tree -r --name-only origin/feature/citas | sort > remote_files.txt

# Comparación: muestra solo archivos que están localmente y no remotamente
comm -23 local_files.txt remote_files.txt

# Limpieza de archivos temporales
rm local_files.txt remote_files.txt
