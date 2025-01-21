Este proyecto tiene la funcion de crear paciente, citas, especialista para agendar citas odontoogica.
Tiene funcion de roles de usuarios, cuenta con reporte de citas, perfiles de pacientes y especialista,
Es un proyecto que aun le falta hacerles mejora es funcional en todo lo que tiene, poco a poco estare actualizandolo hasta su final de uso.
	
	-usuario prueba-

	admin > admin 1234
	recepcionista > Carlos 1234
	especialista > doctor 1234
----------------------------------
-- CONTIENE ---
*
*
*
-
*PACIENTE.
	Crear pacientes.
	lista de pacientes.
	Editar pacientes.
	Eliminar Pacientes.
	Exportar Pacientes.


*CITAS
	Crear citas.
	Lista de citas.
	Editar Citas.
	Eliminar Citas.
	Exportar listado de citas.


*Especialista
	Crear Especialista
	Lista Especialista
	Editar Especialista
	Eliminar Especialista.


*REPORTE
	se puede filtra desde-hasta las citas de los especialista agregado en el sistema.
	Exportar en CSV
	Expostar en PDF


*CONFIGURACION. (opcion admin)	

-BACKUP DB
	PARA CREAR UN BACKUP DE LA BASE DE DATOS SQL. 	

-AUDITORIA
	Una pequeña session donde se registra las acciones de los usuarios. 	

-CREAR ROLES
	donde podemos agregar un usuario del sistema si seran admin, recesionista, especialista. 	

-CAMBIAR CONTRASANA
	Una sesion donde podemos cambiarle la contrasena a los usuarios registrado en el sistema,. 

-MANTENIMIENTO DE USUARIO
	una sesion donde puede inactivar o eliminar usuario del sistema.



*CUENTA CON LA SESION PERFIL DE PACIENTE. 
	LLAMADA PERFIL DE PACIENTE DONDE ELIGES EL PACIENTE Y SALE TODA LA INFORMACION, CITAS  Y SUBIR DOCUMENTO DE ESE PACIENTE. (IMAGEN, TEXTO, DOCUEMNTO PDF, ETC)

*CUENTA CON LA SESION DE PERFIL DE ESPECIALISTA.
	 DONDE TAMBIEN MUESTRA TODA LA CITAS Y SU INFORMACION. CON UN PEQUENO CHART.

*UNA PEQUE;A GRAFICA DE LA CITAS POR DIAS.

*NOTIFICACION
	EN LA PAGINA PRINCIPAL TENEMOS UN CINTILLO DONDE MUESTRA LAS CITAS PROGRAMADA EN EL DIA. CON EL ESPECIALISTA ASIGNADO, CUENTA CON
	UN PEQUENO SONIDO CUANDO SE AGREGA O ACTUALIZA SE ESCUCHA.

Y OTRAS FUNCIONES MAS.


--------------LUEGO DE TENER UN % DE PROYECTO COMENCE A HACERLE UNOS CAMBIOS -----------------


30-11-2024

-Se agrego editar_especialista.
-se mejoro la pagina registrar_especialista, agregando un listado de especialidades.
-un poco de CCS para el boton cerrar seccion de la pagina respaldo.

1-12-2024

-Se agrego archivos subir documento y ver documento.

21-12-2024

-Se modifico la pagina listado paciente, para que muestre la edad del paciente.
-se modifico la pagina editar_pacientes. par que se modifique la edad cuando modifiquemos la fecha.
-se mofigico la pagina perfil_pacientes. para que se muestre la edad del paciente seleccionado.

añadimos
-se agrego autenticacion de usuario (admin, recepcionista, especialista).
-se modifico la pagina configuracion.php ahora si no eres admin no puedes entrar.
	
  -- USUARIOS DE PRUEBA. --
	admin > admin 1234
	recepcionista > Carlos 1234
	especialista > doctor 1234


28-12-2024

-Se agrego una nueva pagina, Perfil_especialista. muestra los datos del especialista y sus citas agendada.
 parecido al de perfil paciente. 
-se agrego un campo en la tabla cita llamada HORA. (base de dato no se realizo bk ante de agregar campo).

31-12-2024

-se ha agregado un grafico en el perfil_especialista.php, que muestra cuantas citas al mes lleva cada especialista.
-se ha creado creado una pagina para crear usuario desde el login. (opcional)
-se a creado una nueva pagina cambiar_contraseña.php la cual tiene como funcion que permite cambiar la contraseña luego que inicies seccion tienes la opcion de hacerlo.
-se creo la pagina cambiar_contraseña_admin.php que solo permite al administrador elegir el usuario y cambiarle la contrania.
-se creo la funcion de eliminar usuario. creado 2 pagina nueva lista_usuario.php y eliminar_usuario.php.

update
-Se agrego una columna de activo/inactivo en la pagina lista_usuario.php lo que permite inactivar el usuario si no queremos eliminarlo.
-se agrego un nuevo campo llamado "estado" en la base de dato de usuarios, para darle funcion a la opcion activo/inactivo. 
-se agrego codigo a la pagina login.php para indicar si el usuario exite o esta inactivo.
--se exporto base dato con los cambio.

5-1-2025

-La pagina Index.php se le agrego un div donde sera la notificacion de citas del dia como tipo recordatorio.
-sirve con slider donde va mostrando todas la citas pautada para el dia.

 UPDATE  5-1-2025.
se modifico la pagina registrar_especialista lo que se le agrego la funcion o tanda del especialista que se valla a registrar
hora de incio y  salida. y se le hizo modificacion a la lista_especialista.php y editar_especialista.php como tambien perfil_especialista.php


6-1-2025

Se ha modificado la pagina registrar_cita.php para que pueda tener la funcion nueva de lo especialista, cuando eliges un especialista te muestra
su tanda y horario. tambien fue modificada lista_cita.php y editar_cita.php por el cambio registrado ya mencionado.
