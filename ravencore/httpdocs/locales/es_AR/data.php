<?php

// the $trans array key is first two letters as ISO 639 language code, underscore,
// and the last two letters ISO 3166 country code.
// ex: en_US  ru_RU  nb_NO  etc

$trans['es_AR'] = array(

	'Name' => 'Nombre',
	'Add Database' => 'Agregar Base de Datos',
	'Invalid password. Must only contain letters and numbers, must be atleast 5 characters, and not a dictionary word' => 'Contrase�a inv&aacute;lida. Debe usar solamente letras y n�meros, m&aacute;s de 5 caracteres y no usar una palabra del diccionario',
	'Adding a user for database' => 'Agregar un usuario para la base de datos',
	'Login' => 'Conexi&oacute;n',
	'Password' => 'Contrase�a',
	'Add User' => 'Agregar Usuario',
	'Your record name and target cannot be the same.' => 'Su nombre de registro y destino no pueden ser iguales.',
	'You cannot enter in a full domain as the record name.' => 'Usted no puede ingresar un dominio completo como el nombre de registro.',
	'You already have a default SOA record set' => 'Usted ya tiene un registro SOA configurado por defecto.',
	'Default Start of Authority' => 'Inicio de Autoridad por Defecto',
	'Record Name' => 'Nombre de Registro',
	'Target IP' => 'IP destino',
	'Nameserver' => 'Servidor de nombres',
	'Mail for the domain' => 'Mail para el dominio',
	'MX Preference' => 'Preferencia MX',
	'Mail Server' => 'Servidor de correo',
	'Alias name' => 'Nombre de Alias',
	'Target name' => 'Nombre de destino',
	'Reverse pointer records are not yet available' => 'Los registros reversos del indicador no est&aacute;n todav&iacute;a disponibles',
	'Invalid DNS record type' => 'Tipo de registro DNS inv&aacute;lido',
	'Add Record' => 'Agregar Registro',
	'Start of Authority for' => 'Inicio de Autoridad para',
	'Mail for' => 'Correo para',
	'must not be an IP!' => '&iexcl;es necesario que no sea una IP!',
	'The server doesn\'t have PHP session functions available.<p>Please recompile PHP with sessions enabled.' => 'El servidor no tiene habilitada la funci&oacute;n de sesi&oacute;n de PHP.<p>Por favor recompile PHP con sesiones permitidas.',
	'You are missing the database configuration file:' => 'Le est&aacute; faltando el archivo de configuraci&oacute;n de la base de datos:',
	'/database.cfg<p>Please run the following script as root:<p>' => '/database.cfg<p>Por favor ejecute el siguiente script como root:<p>',
	'/sbin/database_reconfig' => '/sbin/database_reconfig',
	'' => '',
	'Your system is unable to set uid to root with the wrapper. This is required for ravencore to function. To correct this:<p>' => 'Su sistema no puede setear el uid al root con el wrapper. Esto lo requiere ravencore para poder funcionar. Para corregir esto:<p>',
	'the file: <b>/usr/local/ravencore/sbin/wrapper</b><p>' => 'el archivo: <b>/usr/local/ravencore/sbin/wrapper</b><p>',
	'do one of the following:<p>' => 'haga uno de los siguientes:<p>',
	'Install <b>gcc</b> and the package that includes <b>/usr/include/sys/types.h</b> and restart ravencore<br />\n' => 'Instale <b>gcc</b> y el paquete que incluye <b>/usr/include/sys/types.h</b> y reinicie ravencore<br />\n',
	'/>\n' => '/>\n',
	'Install the <b>perl-suidperl</b> package and restart ravencore<br />\n' => 'Instale el paquete <b>perl-suidperl</b> y reinicie ravencore<br />\n',
	'/>\n' => '/>\n',
	'Copy the wrapper binary from another server with ravencore installed into ravencore\'s sbin/ on this server' => 'Copie el archivo binario wrapper desde otro servidor que tenga ravencore instalado dentro de ravencore\'s sbin/ en este servidor',
	'' => '',
	'to call the mysql_connect function. \n' => 'para llamar la funci&oacute;n del mysql_connect. \n',
	'\t\t\tPlease install the php-mysql package or recompile PHP with mysql support, and restart the control panel.<p>\n' => '\t\t\tPor favor instale el paquete php-mysql o recompile PHP con soporte mysql, y reinicie el panel de control.<p>\n',
	'php-mysql is installed on the server, check to make sure that the mysql.so extention is getting loaded in your system\'s php.ini file' => 'php-mysql esta instalado en el servidor, verifique para estar seguro que la extensi&oacute;n mysql.so consigui&oacute; cargarse en su archivo system\'s php.ini',
	'Unable to get a database connection.' => 'No se pudo establecer una conexi&oacute;n con la base de datos.',
	'Login locked.' => 'ingreso bloqueado.',
	'Login failure.' => 'Error al ingresar.',
	'Control panel is locked for users, because your \"lock if outdated\" setting is active, and we appear to be outdated.' => 'El panel de control es bloqueado para los usuarios, por su \"bloqueo si es anticuado\" est&aacute; activo, y nosotros aparecemos ccomo antiguos.',
	'Login locked because control panel is outdated.' => 'ingreso bloqueado debido a que el panel de control est&aacute; desactualizado.',
	'API command failed. This server is configured as a master server.' => 'Fall&oacute; el comando API. Este servidor esta configurado como servidor maestro.',
	'You must agree to the GPL License to use RavenCore.' => 'Usted debe aceptar la Licencia GPL para usar RavenCore',
	'Please read the GPL License and select the \"I agree\" checkbox below' => 'Por favor lea la Licencia GPL License y tilde la casilla \"Acepto\" que est&aacute; abajo',
	'The GPL License should appear in the frame below' => 'La Licencia GPL debe aparecer en el marco de abajo',
	'I agree to these terms and conditions.' => 'Acepto estos t&eacute;rminos y condiciones.',
	'Welcome, and thank you for using RavenCore!' => 'Bienvenido, y gracias por usar RavenCore',
	'' => '',
	'installed and/or upgraded some packages that require new configuration settings. \n' => 'instalado y/o actualizando algunos paquetes que requieren nuevos ajustes de la configuraci&oacute;n. \n',
	'take a moment to review these settings. We recomend that you keep the default values, \n' => 'tome un momento para repasar estos ajustes. Nosotros recomendamos que usted guarde los valores prefijados, \n',
	'if you know what you are doing, you may adjust them to your liking.\n' => 'si usted sabe lo que est&aacute; haciendo, usted puede ajustarlo a su gusto.\n',
	'' => '',
	'configuration' => 'configuraci&oacute;n',
	'Submit' => 'Enviar',
	'Control Panel is being upgraded. Login Locked.' => 'El Panel de Control esta siendo actualizado. ingreso bloqueado.',
	'The password is incorrect!' => '&iexcl;La contrase�a es incorrecta!',
	'The new password must be greater than 4 characters and not a dictionary word' => 'La nueva contrase�a debe tener m&aacute;s de 4 caracteres y no debe ser una palabra del diccionario',
	'Cannot select MySQL database' => 'No se pudo seleecionar la base de datos MySQL',
	'Cannot change database password' => 'No se pudo cambiar la contrase�a de la base de datos',
	'Unable to flush database privileges' => 'imposible limpiar los privilegios de la base de datos',
	'Cannot open .shadow file' => 'No se pudo abrir el archivo .shadow',
	'Your passwords are not the same!' => '&iexcl;Sus contrase�as no son las mismas!',
	'Please change the password for' => 'Por favor cambie la contrase�a por',
	'Changing' => 'Cambiar',
	'password!' => '&iexcl;contrase�a!',
	'Old Password' => 'Antigua contrase�a',
	'New Password' => 'Nueva contrase�a',
	'Confirm New' => 'Confirmar Nueva',
	'Change Password' => 'Cambiar Contrase�a',
	'Add a crontab' => 'Agregar un crontab',
	'There are no crontabs.' => 'No hay crontabs',
	'User' => 'Usuario',
	'Choose a user' => 'Seleccionar un usuario',
	'Delete Selected' => 'Eliminar seleccionado',
	'Entry' => 'Entrada',
	'Add Crontab' => 'Agregar Crontab',
	'Unable to use mysql database' => 'Imposible usar la base de datos mysql',
	'That database does not exist' => 'La base de datos no existe',
	'Add a Database' => 'Agregar una Base de datos',
	'No databases setup' => 'No hay bases de datos configuradas',
	'Databases for' => 'Bases de dato para',
	'Are you sure you wish to delete this database?' => '&iquest;Est&aacute; usted seguro que desea eliminar esta base de datos?',
	'delete' => 'eliminar',
	'Users for the' => 'Usuarios de el',
	'database' => 'base de datos',
	'Add a database user' => 'Agregar un usuario de base de datos',
	'No users for this database' => 'No hay usuarios para esta base de datos',
	'Delete' => 'Eliminar',
	'Are you sure you wish to delete this database user?' => '&iquest;Est&aacute; usted seguro que desea eliminar este usuario de la base de datos?',
	'Note: You may only manage one database user at a time with the phpmyadmin' => 'Nota: Usted puede manejar solamente a un usuario de la base de datos a la vez con el phpmyadmin',
	'Search' => 'Buscar',
	'Please enter in a search value!' => '&iexcl;Por favor ingrese una b�squeda!',
	'Show All' => 'Mostrar Todo',
	'There are no databases setup' => 'No hay bases de datos configuradas',
	'Your search returned' => 'Su b�squeda devuelve',
	'results' => 'resultados',
	'Domain' => 'Dominio',
	'Database' => 'Base de datos',
	'No DNS records setup on the server' => 'No hay registros DNS configurados en el servidor',
	'The following domains are setup for DNS' => 'Los siguientes dominios estan configurados por DNS',
	'Records' => 'Registros',
	'No SOA record setup for this domain' => 'No hay registros SOA configurados para este dominio',
	'Add SOA record' => 'Agregar un registro SOA',
	'DNS for' => 'DNS para',
	'Start of Authority for' => 'inicio de autoridad para',
	'is' => 'es',
	'No DNS records setup for this domain' => 'No hay registros SOA configurados para este dominio',
	'Record Type' => 'Tipo de Registro',
	'Record Target' => 'Destino de Registro',
	'Add record' => 'Agregar registro',
	'Add' => 'Agregar',
	'No default DNS records setup for this server' => 'No hay registros por defecto configurados para este servidor',
	'Default DNS for domains setup on this server' => 'DNS por defecto para los dominios en este servidor',
	'Domains for' => 'Dominios para',
	'There are no domains setup' => 'No hay dominios configurados',
	'Add a Domain' => 'Agregar un Dominio',
	'Go' => 'ir',
	'Please enter a search value!' => '&iexcl;ingrese por favor un valor de b�squeda!',
	'Space usage' => 'Uso de espacio',
	'Traffic usage' => 'Uso de tr&aacute;fico',
	'View setup information for' => 'Ver informaci&oacute;n de configuraci&oacute;n para',
	'Totals' => 'Totales',
	'You are at your limit for the number of domains you can have' => 'Usted est&aacute; en su l&iacute;mite para de cantidad de dominios que usted puede tener',
	'Add a domain to the server' => 'Agregar un dominio al servidor',
	'Domain does not exist' => 'este dominio no existe',
	'This domain belongs to' => 'Este dominio pertenece a',
	'No One' => 'Nadie',
	'Change' => 'Cambio',
	'info for' => 'informaci&oacute;n de',
	'Delete this domain off the server' => 'Eliminar este dominio del servidor',
	'Are you sure you wish to delete this domain' => '&iquest;Esta usted seguro que desa eliminar este dominio?',
	'Created' => 'Creado',
	'Status' => 'Estado',
	'ON' => 'ENCENDIDO',
	'Are you sure you wish to turn off hosting for this domain' => '&iquest;Est&aacute; usted seguro que desea apagar el alojamiento para este dominio?',
	'Turn OFF hosting for this domain' => 'Apagar alojamiento para este dominio',
	'OFF' => 'APAGADO',
	'Turn ON hosting for this domain' => 'Encender alojamiento para este dominio',
	'Physical Hosting' => 'Alojamiento F&iacute;sico',
	'View/Edit Physical hosting for this domain' => 'Ver/Editar Alojamiento f&iacute;sico para este dominio',
	'edit' => 'editar',
	'Redirect' => 'Redirigir',
	'View/Edit where this domain redirects to' => 'Ver/Editar donde este dominio redirige a',
	'Alias of' => 'Alias de',
	'View/Edit what this domain is a server alias of' => 'Ver/Editar que este dominio sea un servidor alias de',
	'No Hosting' => 'No est&aacute; alojado',
	'Setup hosting for this domain' => 'Configurar el alojamiento para este dominio',
	'Go to the File Manager for this domain' => 'Ir al Administrador de Archivos para este dominio',
	'The file manager is currently offline' => 'El administrador de archivos esta actualmente fuera de servicio',
	'File Manager' => 'Administrador de Archivos',
	'View/Edit Custom Error Documents for this domain' => 'Ver/Editar Documentos de Errores personalizados para este dominio',
	'Error Documents' => 'Documentos de Errores',
	'View/Edit Mail for this domain' => 'Ver/Editar Correo para este dominio',
	'Mail' => 'Correo',
	'( off )' => '( apagar )',
	'View/Edit databases for this domain' => 'Ver/Editar bases de datos para este dominio',
	'Databases' => 'Bases de datos',
	'Manage DNS for this domain' => 'Maneje los registros DNS para este dominio',
	'DNS Records' => 'Registros DNS',
	'View Webstats for this domain' => 'Ver estad&iacute;sticas web para este dominio',
	'Webstats' => 'Estad&iacute;sticas Web',
	'Domain Usage' => 'Uso de dominio',
	'Disk space usage' => 'Uso de espacio en disco',
	'This month\'s bandwidth' => 'Ancho de banda usado estos meses',
	'Illegal argument' => 'Argumento ilegal',
	'Please enter the domain name you wish to setup' => 'Por favor ingrese el nombre de dominio que desea configurar',
	'Invalid domain name. Please re-enter the domain name without the www.' => 'Nombre de Dominio inv&aacute;lido. Por favor reingrese el nombre de dominio sin www.',
	'Invalid domain name. May only contain letters, numbers, dashes and dots. Must not start or end with a dash or a dot, and a dash and a dot cannot be next to each other' => 'Nombre de Dominio inv&aacute;lido. Puede contener solamente letras, n�meros, guiones y puntos. No debe empezar o terminar con un gui&oacute;n o un punto, y un gui&oacute;n o un punto no pueden estar al lado de otro',
	'Control Panel User' => 'Usuario de Panel de Control',
	'Select One' => 'Seleccionar Uno',
	'Add domain' => 'Agregar dominio',
	'Add Domain' => 'Agregar Dominio',
	'Proceed to hosting setup' => 'Poceder a configurar el alojamiento',
	'Add default DNS to this domain' => 'Agregar DNS por defecto para este dominio',
	'That email address already exists' => 'Esta direcci&oacute;n de email ya existe',
	'Your passwords do not match' => 'Las contrase�as no son las mismas',
	'You selected you wanted a redirect, but left the address blank' => 'Usted seleccion&oacute; deseo volver a redirigir, pero dej&oacute; la direcci&oacute;n vac&iacute;a',
	'Invalid password. Must only contain letters and numbers.' => 'Contrase�a inv&aacute;lida. Debe contener letras y n�meros',
	'The redirect list contains an invalid email address.' => 'La lista de redirecci&oacute;n contiene una direcci&oacute;n de email no v&aacute;lida.',
	'Invalid mailname. it may only contain letters, number, dashes, dots, and underscores. Must both start and end with either a letter or number.' => 'Nombre de mail no v&aacute;lido. Puede contener solamente letras, n�meros, puntos, y rayas. El comienzo y fin necesitan letra o n�mero',
	'Mail is disabled for' => 'Mail est&aacute; deshabilitado por',
	'. You can not add an email address for it.' => '. Usted no puede agregar una direcci&oacute;n de email para &eacute;l.',
	'Edit' => 'Editar',
	'mail' => 'correo',
	'Mail Name' => 'Nombre de mail',
	'Confirm' => 'Confirmar',
	'Mailbox' => 'Casilla de mensajes',
	'Mail will not be stored on the server if you disable this option. Are you sure you wish to do this?' => 'El correo no sera guardado en el servidor si usted deshabilita esta opci&oacute;n. &iquest;Est&aacute; usted seguro que desea hacer esto?',
	'List email addresses here, seperate each with a comma and a space' => 'Lista de direcciones de email, separe cada uno con una coma y un espacio.',
	'Add Mail' => 'Agregar email',
	'Update' => 'Actualizar',
	'You must enter a name for this user' => 'Debe ingresar un nombre para este usuario',
	'You must enter a password for this user' => 'Debe ingresar una contrase�a para este usuario',
	'Your password must be atleast 5 characters long, and not a dictionary word.' => 'Su contrase�a debe tener al menos 5 caracteres, y no debe ser una palabra del diccionario.',
	'The email address entered is invalid' => 'La direcci&oacute;n de email ingresada no es v&aacute;lida',
	'info' => 'informaci&oacute;n',
	'Full Name' => 'Nombre Completo',
	'Email Address' => 'Direcci&oacute;n de Email',
	'Edit info' => 'Editar informaci&oacute;n',
	'Proceed to Permissions Setup' => 'Proceder a la Configuraci&oacute;n de Permisos',
	'Required fields' => 'Campos requeridos',
	'Are you sure you wish to delete this user?' => '&iquest;Est&aacute; usted seguro que desea eliminar este usuario?',
	'No custom error documents setup.' => 'No hay documentos de error personalizados.',
	'Add Custom Error Document' => 'Agregar Documento de Error Personalizado',
	'Code' => 'C&oacute;digo',
	'File' => 'Archivo',
	'List HTTP Status Codes' => 'Lista de C&oacute;digos de Estado HTTP',
	'This server does not have' => 'este servidor no tiene',
	'installed. Page cannot be displayed.' => 'instalado. La p&aacute;gina no puede ser mostrada.',
	'Unable to connect to DB server! Attempting to restart mysql' => '&iexcl;imposible contarse al servidor de base de datos! Procure reiniciar mysql',
	'Restart command completed. Please refresh the page.' => 'Comando de reinicio completado. Por favor refresque la p&aacute;gina.',
	'If the problem persists, contact the system administrator' => 'Si el problema persiste, cont&aacute;ctese con el administrador del sistema',
	'You are not authorized to view this page' => 'Usted no est&aacute; autorizado para ver esta p&aacute;gina',
	'List control panel users' => 'Lista de usuarios del panel de control',
	'Users' => 'Usuarios',
	'List domains' => 'Lista de dominios',
	'Domains' => 'Dominios',
	'List email addresses' => 'Lista de direcciones de email',
	'List databases' => 'Lista de bases de datos',
	'DNS for domains on this server' => 'DNS para los dominios en este servidor',
	'DNS' => 'DNS',
	'Manage system settings' => 'Manejar configuraciones del sistema',
	'System' => 'Sistema',
	'Goto main server index page' => 'ir a la pagina principal',
	'Main Menu' => 'Men� Principal',
	'List your domains' => 'Listado de sus dominios',
	'My Domains' => 'Mis Dominios',
	'List all your email accounts' => 'Listado de todas sus cuentas de email',
	'My email accounts' => 'Mis cuentas de email',
	'Logout' => 'Desconectarse',
	'Are you sure you wish to logout?' => '&iquest;Est&aacute; usted seguro que desea desconectarse?',
	'Are you sure you wish to delete hosting for this domain?' => '&iquest;Est&aacute; usted seguro que desea eliminar el alojamiento para este dominio?',
	'delete hosting' => 'eliminar alojamiento',
	'www prefix' => 'prefijo wwww',
	'Yes' => 'Si',
	'No' => 'No',
	'FTP Username' => 'Usuario de FTP',
	'FTP Password' => 'Contrase�a de FTP',
	'Shell' => 'Consola',
	'SSL Support' => 'Soportar SSL',
	'If you disable ssl support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Si usted deshabilita el soporte de ssl, no podr&aacute; habilitar este nuevamente.\\r&iquest;Est&aacute; usted seguro que desea hacer esto?',
	'PHP Support' => 'Soportar PHP',
	'If you disable php support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Si usted deshabilita el soporte de php, no podr&aacute; habilitar este nuevamente.\\r&iquest;Est&aacute; usted seguro que desea hacer esto?',
	'CGI Support' => 'Soportar CGI',
	'If you disable cgi support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Si usted deshabilita el soporte de cgi, no podr&aacute; habilitar este nuevamente.\\r&iquest;Est&aacute; usted seguro que desea hacer esto?',
	'Directory indexing' => 'indice de directorios',
	'This domain is an alias of' => 'Este dominio es un alias de',
	'Host on this server' => 'Alojar en este servidor',
	'Redirect to another domain' => 'Redireccionar a otro dominio',
	'Show contents of another site on this server' => 'Mostrar contenidos de otro sitio en este servidor',
	'Continue' => 'Continuar',
	'Are you sure you wish to delete this log file?' => '&iquest;Esta usted seguro que desea eliminar este archivo de registro de actividades?',
	'Log files for' => 'Archivos de registro de actividades para',
	'Manage' => 'Manejo',
	'Go to log rotation manager for' => 'ir al manejo de la rotaci&oacute;n de registro de actividades para',
	'Log Rotation' => 'Rotaci&oacute;n del registro de actividades',
	'Log Name' => 'Nombre del registro de actividades',
	'Compression' => 'Compresi&oacute;n',
	'File Size' => 'Tama�o de Archivo',
	'Download the' => 'Descargar el',
	'Custom log rotation for' => 'Encargo de rotaci&oacute;n de registro de actividades para',
	'is' => 'es',
	'Are you sure you wish to turn off the custom log rotation for' => '&iquest;Est&aacute; usted seguro que desea detener el encargo de la rotaci&oacute;n de registro de actividades para',
	'Turn OFF log rotation for' => 'Detener rotaci&oacute;n de registro de actividades para',
	'Turn ON log rotation for' => 'Encender rotaci&oacute;n de registro de actividades para',
	'You must choose how many log files you wish to keep!' => '&iexcl;Usted debe elegir cu&aacute;ntos ficheros de registro de actividades desea guardar!',
	'You must make a rotation selection: filesize, date, or both' => 'Usted debe hacer una selecci&oacute;n de la rotaci&oacute;n:  tama�o de archivo, fecha, o ambos',
	'Keep' => 'Subsistir',
	'log files' => 'archivos de registro de actividades',
	'Rotate by' => 'Rote cerca',
	'Filesize' => 'Tama�o de archivo',
	'Date' => 'Fecha',
	'Daily' => 'Diario',
	'Weekly' => 'Semanal',
	'Monthly' => 'Mensual',
	'Email about-to-expire files to' => 'Email archivos acerca-de-expiraci&oacute;n a',
	'Compress log files' => 'Comprimir archivos de registro de actividades',
	'No domains setup, so there are no Log files' => 'No hay dominios configurados, entonces no hay ning�n archivo de registro de actividades',
	'Please Login' => 'Por favor con&eacute;ctese',
	'Username' => 'Nombre de usuario',
	'Language' => 'Lenguaje',
	'English' => 'Espa�ol',
	'Your login is secure' => 'Su conexi&oacute;n es segura',
	'Go to Secure Login' => 'Ir a Conexi&oacute;n Segura',
	'Goto' => 'Ir a',
	'Turn ON mail for' => 'Encender correo para',
	'Turn OFF mail for' => 'Apagar correo para',
	'Are you sure you wish to disable mail for this domain?' => '&iquest;Est&aacute; usted seguro que desea deshabilitar el correo para este dominio?',
	'Mail sent to email accounts not set up for this domain ( catchall address )' => 'Correo enviado a las cuentas del email no instaladas para este dominio (direcci&oacute;n para tomar todos)',
	'Send to' => 'Enviar a',
	'Bounce with' => 'Despedida con',
	'Delete it' => 'Eliminar esto',
	'Forward to that user' => 'Remitir a este usuario',
	'You need at least two domains in the account with mail turned on to be able to alias mail' => 'Usted necesita por lo menos dos dominios en la cuenta con el correo funcionando para poder usar el correo de alias',
	'No mail for this domain.' => 'No hay mail para este dominio.',
	'Mail for this domain' => 'Mail para este dominio',
	'Webmail' => 'Webmail',
	'Webmail is currently offline' => 'Webmail est&aacute; actualmente fuera de l&iacute;nea',
	'offline' => 'fuera de l&iacute;nea',
	'If you delete this email, you may not be able to add it again.\\rAre you sure you wish to do this?' => 'Si usted elimina este email, usted no podr&aacute; volver a agrgarlo otra vez.\\r&iquest;Est&aacute; usted seguro que desea hacer esto?',
	'Are you sure you wish to delete this email?' => '&iquest;Est&aacute; usted seguro que desea eliminar este email?',
	'This user is only allowed to create' => 'Se permite a este usuario solamente crear',
	'email accounts. Are you sure you want to add another?' => 'cuentas de email. &iquest;Est&aacute; usted seguro que desea agregar otra?',
	'Add an email account' => 'Agregue una cuenta de email',
	'You have no domains setup.' => 'Usted no tiene dominios configurados',
	'Create a new email account' => 'Crear una nueva cuenta de correo',
	'Add an email address' => 'Agregar una direccion de email',
	'There are no mail users setup' => 'No hay usuarios de correo configurados',
	'Email Addresses' => 'Direcci&oacute;n de Email',
	'Service' => 'Servicio',
	'Running' => 'Funcionando',
	'Start' => 'iniciar',
	'Stop' => 'Detener',
	'Restart' => 'Reiniciar',
	'IP Address' => 'Direcci&oacute;n IP',
	'Session Time' => 'Teimpo en sesi&oacute;n',
	'Idle Time' => 'Tiempo ocioso',
	'Remove' => 'Quitar',
	'Stop/Start system services such as httpd, mail, etc' => 'Detiene/inicia servicios del sistema, por ejemplo httpd, mail, etc',
	'System Services' => 'Servicios del Sistema',
	'View who is logged into the server, and where from' => 'Ver qui&eacute;n esta conectado al servidor, y desde donde',
	'Login Sessions' => 'Conexiones Activas',
	'Services that automatically start when the server boots up' => 'Servicios que inician autom&aacute;ticamente cuando el servidor se enciende.',
	'Startup Services' => 'Servicios de Arranque',
	'The DNS records that are setup for a domain by default when one is added to the server' => 'Los registros DNS son configurados para un dominio por defecto cuando uno es agregado al servidor',
	'Default DNS' => 'DNS por defecto',
	'Change the admin password' => 'Cambia la contrase�a de administrador',
	'Change Admin Password' => 'Cambiar la Contras�a de Administrador',
	'Load phpMyAdmin for all with MySQL admin user' => 'Carga phpMyAdmin para todo con el usuario de administraci&oacute;n de MySQL',
	'Admin MySQL Databases' => 'Administrar bases de datos MySQL',
	'View general system information' => 'Ver informaci&oacute;n general del sistema',
	'System info' => 'informaci&oacute;n del Sistema',
	'View output from the phpinfo() function' => 'Ver el despliegue de la funci&oacute;n phpinfo()',
	'PHP info' => 'informaci&oacute;n de PHP',
	'View Mail Queue' => 'Ver cola de Mail',
	'Are you sure you wish to reboot the system?' => '&iquest;Est&aacute; usted seguro que desea reiniciar el sistema?',
	'Reboot the server' => 'Reiniciar el servidor',
	'Reboot Server' => 'Reiniciar Servidor',
	'You are about to shutdown the system. There is no way to bring the server back online with this software. Are you sure you wish to shutdown the system?' => 'Usted est&aacute; por apagar el sistema. No hay manera de iniciar el servidor en l&iacute;nea con este software. &iquest;Est&aacute; usted seguro que desea apagar el sistema?',
	'Shutdown the server' => 'Apagar el Servidor',
	'Shutdown Server' => 'Apagar Servidor',
	'This user can' => 'Este usuario puede',
	'Create' => 'Crear',
	'Note: A negative limit mean unlimited' => 'Nota: Un limite negativo lo hace ilimitado',
	'You can\'t add domains' => 'Usted no puede agregar dominios',
	'You can\'t add databases' => 'Usted no puede agregar bases de datos',
	'You can\'t add cron jobs' => 'Usted no puede agregar tareas temporales',
	'You can\'t add email addresses' => 'Usted no puede agregar direcciones de email',
	'You can\'t add DNS records' => 'Usted no puede agregar registros al DNS',
	'You can\'t add cgi to hosting on any domains' => 'Usted no puede agregar el uso de cgi para el alojamiento de los dominios',
	'You can\'t add php to hosting on any domains' => 'Usted no puede agregar el uso de php para el alojamiento de los dominios',
	'You can\'t add ssl to hosting on any domains' => 'Usted no puede agregar el uso de ssl para el alojamiento de los dominios',
	'You can\'t add shell users' => 'Usted no puede agregar usuarios de consola',
	'There are no users setup' => 'No hay usuarios configurados',
	'View user data for' => 'Ver datos de usuario por',
	'Add a user to the control panel' => 'Agregar un usuario al panel del control',
	'Add a Control Panel user' => 'Agregar un usuario de Panel de Control',
	'User does not exist' => 'El usuario no existe',
	'This user is locked out due to failed login attempts' => 'Este usuario ha sido bloqueado debido a las constantes conexiones fallidas',
	'Unlock' => 'Desbloquear',
	'Company' => 'Compa�&iacute;a',
	'Contact email' => 'Email de contacto',
	'Login ID' => 'Identificador de Conexi&oacute;n',
	'Edit account info' => 'Editar su informaci&oacute;n de cuenta',
	'See what you can and can not do' => 'Vea lo que usted puede y no puede hacer',
	'View/Edit Permissions' => 'Ver/Editar Permisos',
	'View Permissions' => 'Ver Permisos',
	'Options' => 'Opciones',
	'You have no domains setup' => 'Usted no tiene dominios configurados',
	'No domains setup' => 'No hay dominios configurados',
	'For which domain' => 'Para qu&eacute; dominio',
	'Back' => 'Volver',
	'Add a MySQL database' => 'Agregar una base de datos MySQL',
	'Add E-Mail Account' => 'Agregar una cuenta de E-Mail',
	'Add/Edit DNS records' => 'Agregar/Editar registros DNS',
	'View Webstatistics' => 'Ver estad&iacute;sticas web',
	'List all of your domain names' => 'Listado de todos sus nombres de dominio',
	'List Domains' => 'Lista de Dominios',
	'This user is at his/her domain limit' => 'Este usuario est&aacute; en su l&iacute;mite del dominios',
	'Add one anyway' => 'Agregar uno de todos modos',
	'Domain usage' => 'Uso de dominio',
	'Traffic usage (This month)' => 'Tr&aacute;fico usado (Este mes)',
	'is not setup for physical hosting. Webstats are not available' => 'no est&aacute; configurado para alojamiento f&iacute;sico. La estad&iacute;stica web no est&aacute; disponible',
	'OK' => 'Aceptar',
	'SSH Terminal' => 'Terminal SSH'

	);

?>
