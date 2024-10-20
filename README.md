# Cursos-de-belleza
Integrantes: Alcibar Lucia y Figueroa Milagros.
Decidimos que nuestro trabajo se va a basar en un sitio web dedicado a cursos de belleza, donde el usuario se va a poder inscribir a los cursos que desee. Para esto, necesitara ingresar una serie de datos/atributos refiriendose a su infomación personal y al curso que solicita unirse. Con estos datos instantaneamente quedara registrado en una base de datos. Es por esto que creamos tres tablas: alumnos, cursos e inscriptos. En la primera se guardan los datos de los inscriptos, en la segunda, se indican datos sobre los cursos disponibles; y finalmente, la tercer tabla permite crear las relaciones entre alumnos y cursos, guardando los alumnos inscriptos a cada curso.
## diagrama base de datos
![Diagrama_BD](https://github.com/user-attachments/assets/b00bf0eb-d87f-4556-9b3e-094203d96c22)
En este diagrama se representan los atributos que posee cada tabla y la relación entre ellas.
## explicación de la segunda parte del TPE
Interpretamos a partir de la consigna, que a nuestro sitio web tendría un usuario administrador y un usuario normal o no administrador. Por lo tanto en la tabla usuario correspondiente a sql, agregamos la columna "rol" el cual va a determinar si la persona que esta logueandose pertenece a un usuario administrador o no. Si corresponde al primer rol, este usuario va a poder editar, borrar y agregar nuevos cursos o alumnos. Sin embargo, si es un usuario no administrador no va a poder llevar a cabo las acciones correspondientes del otro usuario, solo podrá ver los cursos y alumnos (con sus clasificaciones) pero sin modificar nada. Para poder realizar estas pruebas creamos un usuario no administraodor con los siguientes datos:
*Usuario: luciaalcibar3@gmail.com 
*Password: hola123
Mientras que para el usuario administrador se podrá ingresar mediante el usuario y password pedidos en la consigna, es decir, webadmin como usuario y admin como password.
Por otro lado, haciendo referencia a la parte pública y privada del sitio, al ingresar lo único que va a poder hacer el usuario que no está logueado es ver el home, para realizar cualquier otra acción correspondiente al curso deberá loguearse, por lo tanto, se encontrará automáticamente en la parte privada del sitio. 
