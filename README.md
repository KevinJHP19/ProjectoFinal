# ProjectoFinal
## Descripción General
El proyecto consiste en el desarrollo de una plataforma web donde los usuarios pueden
explorar, subir, organizar y gestionar imágenes con etiquetas. La plataforma permitirá la
interacción entre usuarios mediante funciones como "me gusta" y la posibilidad de guardar
imágenes en un perfil. Además, contará con un sistema de roles que diferenciará las
funcionalidades disponibles para cada tipo de usuario.

## Objetivo del Proyecto
Crear una galería de imágenes dinámica e intuitiva que permita a los usuarios visualizar,
buscar y compartir imágenes de manera sencilla, garantizando una gestión eficiente
mediante un sistema de administración.
### Roles y funciones:
- Usuario no registrado:
    + Podrá visualizar las imágenes.
    + Podrá buscar las imágenes por etiquetas.
- Usuario registrado:
    + Podrá visualizar, buscar las imágenes por etiquetas.
    + Podrá descargar la imagen.
    + Podrá subir sus imágenes.
    + Podrá dar me gusta a las imágenes.
    + Podrá guardar en su perfil las imágenes que les dio me gusta.
- Administrador:
    + Podrá eliminar usuarios e imágenes de usuarios.
    + Podrá verificar las imágenes de los usuarios antes de ponerlas en la
página principal.
    + Podrá hacer lo mismo del usuario registrado.

## Casos de uso
#### 1. Registrar usuario

Actores: Usuario no registrado.

Precondiciones: El usuario no ha iniciado sesión.

Flujo básico:
* El usuario navega en la página de registro.
* El usuario introduce su nickname, email y contraseña.
* El sistema valida que los campos estén completos y que el email no este
registrado previamente.
* El sistema crea un nuevo usuario con los datos proporcionados.
* El sistema confirma y redirige al usuario a la página de inicio.
#### 2. Iniciar sesión
Actores: Usuario

Precondiciones: El usuario ha iniciado sesión.

Flujo básico:
* El usuario navega a la página de inicio de sesión.
* El usuario introduce su email y contraseña.
* El sistema valida las credenciales y crea una sesión para el usuario.
* El sistema redirige al usuario a la página principal de la aplicación.
Flujos alternativos:

* Las credenciales son incorrectas: el sistema muestra un mensaje de error y
no crea la sesión.

### 3. Cerrar sesión
Actores: Usuario.

Precondiciones: El usuario ha iniciado sesión.

Flujo básico:
* El usuario hace clic en el botón de “cerrar sesión”.
* El sistema cierra la sesión del usuario.
* El sistema redirige al usuario a la página de inicio.

#### 4. Ver/Editar perfil

Actores: Usuario.

Precondiciones: El usuario ha iniciado sesión.

Flujo básico:
* El usuario navega a la página de edición de perfil.
* El usuario edita su nickname y contraseña.
* El sistema valida los campos y actualiza el perfil del usuario.
* El sistema muestra un mensaje de confirmación.

#### 5. Ver imágenes/me gusta

Actores: Usuario, Usuario no registrado y Administrador.

Precondiciones: ninguna.

Flujo básico:
* El usuario navega a la página principal.
* El usuario observara los me gusta de la imagen.
* El usuario filtra las imágenes a partir de un buscador o etiqueta.
#### 6. Descargar imagen /Dar me gusta

Actores: Usuario y Administrador.

Precondiciones: El usuario ha iniciado sesión.

Flujo básico:
* El usuario navega a la página principal.
* El usuario podrá dar me gusta a las imágenes al tocar el botón.
* El usuario descargara la imagen al darle al botón.
* El sistema subirá de cantidad cuando el usuario le dé al botón de me
gusta.
#### 7. Subir Imagen

Actores: Usuario y Administrador.

Precondiciones: El usuario ha iniciado sesión.

Flujo básico:
* El usuario navega a la página de subir imagen.
* El usuario introduce el nombre, imagen y etiquetas de la imagen.
* El sistema valida los campos y sube la imagen.
* El sistema muestra un mensaje de confirmación y redirige al usuario a la
página principal.
#### 8. Ver me gusta

Actores: Usuario y Administrador.

Precondiciones: El usuario ha iniciado sesión y dado me gusta a alguna imagen.

Flujo básico:
* El usuario navega a la página de perfil.
* El usuario puede observar la imagen que puso me gusta.

#### 9. Ver/eliminar usuario:

Actores: Usuario administrador

Precondiciones: El usuario debe haber iniciado sesión en la aplicación y debe
tener el rol administrador.

Flujo principal:
* El usuario selecciona la opción de “Ver usuarios”.
* El sistema muestra una tabla con inputs con los datos de los
usuarios.

* El administrador hace clic sobre el icono de eliminar usuario.
* El sistema muestra una confirmación de que la información de que
el usuario ha sido borrado correctamente.

#### 10. Eliminar imágenes:

Actores: Usuario administrador.

Precondiciones: El usuario ha iniciado sesión y debe tener el rol administrador.

Flujo principal:
* El usuario administrador navega a la página principal.
* El usuario administrador podrá ver al botón de eliminar.
* El sistema eliminara la imagen al darle al botón de eliminar.

## Diagrama de casos de uso

![Diagramadecasosdeuso](./diagrama%20de%20casos%20de%20uso.png)
