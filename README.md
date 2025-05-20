# ProyectoBD

ProyectoBD es una aplicación web para una tienda de zapatos llamada **ZapasCOL**. La aplicación permite a los usuarios explorar productos, registrarse, iniciar sesión, agregar productos al carrito y realizar compras. Además, cuenta con un panel de administración para gestionar usuarios, productos y ver estadísticas.

## Estructura del Proyecto

- admin.php 
 Panel de administración para usuarios con rol *admin*. Muestra estadísticas, productos con bajo stock y auditoría de usuarios.

- index.php
  Página principal donde se listan los productos y se permite buscarlos.

- login.php 
   Página de inicio de sesión para los usuarios.

- register.php
   Página de registro para nuevos usuarios.

- logout.php
   Cierra la sesión del usuario y redirige a la página principal.

- cart.php 
  Muestra el carrito de compras actual, total de productos y permite eliminar productos.

- add_to_cart.php 
   Procesa la adición de productos al carrito.

- remove_from_cart.php 
   – Permite eliminar productos del carrito.

- **functions.php**  
  Funciones auxiliares, por ejemplo, para formatear precios y conectar con la base de datos.

- db.sql 
 Script SQL para crear y poblar la base de datos `tienda_zapatos` con tablas, triggers y datos iniciales.

- css/style.css 
 Estilos CSS para toda la aplicación.

- Otros archivos y recursos  
  Imágenes en la carpeta img/


## Uso

- Navegación: Explora los diferentes zapato que tenemos en la página principal.
- Cuenta de usuario: Regístrate y/o inicia sesión para acceder a funciones adicionales como agregar productos al carrito.
- Carrito de compras:*Agrega productos al carrito utilizando dandole click al boton, y revisa o elimina productos desde la pestaña del carrito.
- Administración: Un usuario con rol *admin*, accede al panel de administración

----------------------------------------------------------------------------------------------------

Este proyecto es una implementación simple de una tienda de zapatos que incluye funcionalidades básicas y administración de usuarios.
