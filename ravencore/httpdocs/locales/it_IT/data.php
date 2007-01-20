<?

// the $trans array key is first two letters as ISO 639 language code, underscore,
// and the last two letters ISO 3166 country code.
// ex: en_US  ru_RU  nb_NO  etc

$trans['it_IT'] = array(

	'Name' => 'Nome',
	'Add Database' => 'Aggiungi Database',
	'Invalid password. Must only contain letters and numbers, must be atleast 5 characters, and not a dictionary word' => 'Password non valida. Deve contentere solo caratteri e numeri, deve essere di almeno 5 caratteri e si sconsigliano parole da dizionario',
	'Adding a user for database' => 'Aggiungi un utente per il database',
	'Login' => 'Login',
	'Password' => 'Password',
	'Add User' => 'Aggiungi Utente',
	'Your record name and target cannot be the same.' => 'Il Tuo nome record e il tuo target non possono essere uguali',
	'You cannot enter in a full domain as the record name.' => 'Non puoi inserire un nome di dominio completo come nome di record',
	'You already have a default SOA record set' => 'Hai gi� settato un record SOA di default',
	'Default Start of Authority' => 'Default Start of Authority',
	'Record Name' => 'Nome Record',
	'Target IP' => 'IP di Destinazione',
	'Nameserver' => 'NameServer',
	'Mail for the domain' => 'Indirizzo Mail per il dominio',
	'MX Preference' => 'Settaggio MX',
	'Mail Server' => 'Server di Posta',
	'Alias name' => 'Nome Alias',
	'Target name' => 'Nome di Destinazione',
	'Reverse pointer records are not yet available' => 'Il record del puntatore per risoluzione inversa non � al momento avviabile ',
	'Invalid DNS record type' => 'Tipo di DNS record invalido',
	'Add Record' => 'Aggiungi Record',
	'Start of Authority for' => 'Area di Autorit� per',
	'Mail for' => 'Indirizzo Mail per',
	'must not be an IP!' => 'non deve essere un IP!',
	'The server doesn\'t have PHP session functions available.<p>Please recompile PHP with sessions enabled.' => 'Il server non ha una sessione php utilizzabile.<p>ricompila il PHP con una sessione abilitata',
	'You are missing the database configuration file:' => 'non trovo il file di configurazione per il database',
	'/database.cfg<p>Please run the following script as root:<p>' => '/database.cfg<p> Per favore esegui questo script come root:<p>',
	'/sbin/database_reconfig' => '/sbin/database_reconfig',
	'' => '',
	'Your system is unable to set uid to root with the wrapper. This is required for ravencore to function. To correct this:<p>' => 'Il tuo siteme non � in grado di settare il setuid sull\'utenza root con il wrapper. Questo � richiesto per le funzioni di RavenCore. Per correggiere fai questo:<p>',
	'the file: <b>/usr/local/ravencore/sbin/wrapper</b><p>' => 'il file: <b>/usr/local/ravencore/sbin/wrapper',
	'do one of the following:<p>' => 'fai una delle seguenti:',
	'Install <b>gcc</b> and the package that includes <b>/usr/include/sys/types.h</b> and restart ravencore<br />\n' => 'installa<b>gcc</b> il quale include <b>/usr/include/sys/type.h</b>e restarta ravencore<br />\n',
	'/>\n' => '',
	'Install the <b>perl-suidperl</b> package and restart ravencore<br />\n' => 'Installa il pacchetto <b>perl-suidperl<b> e riesegui ravencore',
	'/>\n' => '',
	'Copy the wrapper binary from another server with ravencore installed into ravencore\'s sbin/ on this server' => 'Copia il binario del wrapper da un\'altro server con ravencore istallato in /sbin sul server',
	'' => '',
	'to call the mysql_connect function. \n' => 'per chiamare la mysql_connect function. \n',
	'\t\t\tPlease install the php-mysql package or recompile PHP with mysql support, and restart the control panel.<p>\n' => '\t\t\tPerfavore installa il pacchetto php-mysql oppure ricompila il php con il supporto per mysql,e riesegui il pannello di controllo.<p>\n',
	'php-mysql is installed on the server, check to make sure that the mysql.so extention is getting loaded in your system\'s php.ini file' => 'php-mysql � installato sul server ,controlla che sia presente l\'estensione mysql.so e che sia caricata sul tup file di sistema php.ini',
	'Unable to get a database connection.' => 'Impossibile instaurare una connessioe al database',
	'Login locked.' => 'Login Bloccato',
	'Login failure.' => 'Login Fallito',
	'Control panel is locked for users, because your \"lock if outdated\" setting is active, and we appear to be outdated.' => 'Il pannello di controllo � bloccato per gli utenti, perch� \"il blocco � scaduto\" settandolo attivo,e gli utenti appaiono scaduti',
	'Login locked because control panel is outdated.' => 'Login bloccato perch� il pannello di controllo � scaduto',
	'API command failed. This server is configured as a master server.' => 'comando API fallito. Questo server � configurato come server master',
	'You must agree to the GPL License to use RavenCore.' => 'Devi accettare la licensa GPL per usare RavenCore',
	'Please read the GPL License and select the \"I agree\" checkbox below' => 'Per favore leggia la licensa GPL e seleziona \"I agree\" checkbox sotto',
	'The GPL License should appear in the frame below' => 'La licensa GPL � presente nel form qui sotto',
	'I agree to these terms and conditions.' => 'Acetto questi termini di condizioni',
	'Welcome, and thank you for using RavenCore!' => 'Benvenuto, e grazie per usare RavenCore',
	'' => '',
	'installed and/or upgraded some packages that require new configuration settings. \n' => 'installati e/o aggiornati diversi pacchetti che richiedevano nuovi settaggi di configurazione',
	'take a moment to review these settings. We recomend that you keep the default values, \n' => 'un momento per rivedere i settaggi.Raccomandiamo di mantenere i valori di default',
	'if you know what you are doing, you may adjust them to your liking.\n' => 'Se sai ci� che stai facendo, puoi procedere regolando come vuoi',
	'' => '',
	'configuration' => 'configurazione',
	'Submit' => 'Invia',
	'Control Panel is being upgraded. Login Locked.' => 'Il Pannello di controllo sta in aggiornamento. Login Bloccato',
	'The password is incorrect!' => 'La password � sbaliata!',
	'The new password must be greater than 4 characters and not a dictionary word' => 'La nuova password deve essere pi� lunga di 4 caratteri e non deve essere una parola da dizionario',
	'Cannot select MySQL database' => 'Non posso selezionare il database MySQL',
	'Cannot change database password' => 'Non posso cambiare la password del database',
	'Unable to flush database privileges' => 'Impossibile svuotare le tabelle dei permessi del database',
	'Cannot open .shadow file' => 'non posso aprire il file .shadow',
	'Your passwords are not the same!' => 'Le tue password non sono uguali!',
	'Please change the password for' => 'per favore cambia la password per',
	'Changing' => 'Cambiando',
	'password!' => 'password!',
	'Old Password' => 'Vecchia Password',
	'New Password' => 'Nuova Password',
	'Confirm New' => 'Conferma Nuova',
	'Change Password' => 'Cambio Password',
	'Add a crontab' => 'Aggiungi un crontab',
	'There are no crontabs.' => 'Non ci sono crontab',
	'User' => 'Utente',
	'Choose a user' => 'Scegli un utente',
	'Delete Selected' => 'Cancella Selezionato',
	'Entry' => 'Entry',
	'Add Crontab' => 'Aggiungi Crontab',
	'Unable to use mysql database' => 'Non riesco a utilizzare il database mysql',
	'That database does not exist' => 'Questo database non esiste',
	'Add a Database' => 'Aggiungi un Database',
	'No databases setup' => 'No setup database', 
	'Databases for' => 'Database per',
	'Are you sure you wish to delete this database?' => 'Sei sicuro di voler cancellare questo database?',
	'delete' => 'cancella',
	'Users for the' => 'Utenti per le',
	'database' => 'database',
	'Add a database user' => 'Aggiungi un utente per il database',
	'No users for this database' => 'Nessun utente per questo database',
	'Delete' => 'Cancella',
	'Are you sure you wish to delete this database user?' => 'Sei sicuro di voler cancellare questa utenza per il database?',
	'Note: You may only manage one database user at a time with the phpmyadmin' => 'Nota: tu puoi solo manipolare un utente database per volta tramite phpmyadmin',
	'Search' => 'Cerca',
	'Please enter in a search value!' => 'Per favore inserire in valore di ricerca!',
	'Show All' => 'Mostra tutti',
	'There are no databases setup' => 'non c\'e setup per il database',
	'Your search returned' => 'il risultato della ricerca',
	'results' => 'risultato',
	'Domain' => 'Dominio',
	'Database' => 'Database',
	'No DNS records setup on the server' => 'Nessun record DNS impostato sul server',
	'The following domains are setup for DNS' => 'I seguenti domini sono impostati per il DNS',
	'Records' => 'Records',
	'No SOA record setup for this domain' => 'Nessun record SOA per il dominio impostato',
	'Add SOA record' => 'Aggiungi un record SOA',
	'DNS for' => 'DNS per',
	'Start of Authority for' => 'Inizio della zona di Autorit� per ',
	'is' => '�',
	'No DNS records setup for this domain' => 'Nessun record DNS impostato per questo dominio',
	'Record Type' => 'Tipo di Record',
	'Record Target' => 'Record di Destinazione',
	'Add record' => 'Aggiungi record',
	'Add' => 'Aggiungi',
	'No default DNS records setup for this server' => 'Nessun record DNS di default � impostato su questo server',
	'Default DNS for domains setup on this server' => 'I DNS di default impostati per questo server',
	'Domains for' => 'Domini per',
	'There are no domains setup' => 'Non ci sono domnini impostati',
	'Add a Domain' => 'Aggiungi un Dominio',
	'Go' => 'Vai',
	'Please enter a search value!' => 'Per favore inserire un valore di ricerca!',
	'Space usage' => 'Spazio utilizzato',
	'Traffic usage' => 'Traffico utilizzato',
	'View setup information for' => 'Visualizza le impostazioni per',
	'Totals' => 'Totale',
	'You are at your limit for the number of domains you can have' => 'Sei al limite per i domini che puoi possedere!',
	'Add a domain to the server' => 'Aggiungi un dominio al server',
	'Domain does not exist' => 'il dominio non esiste',
	'This domain belongs to' => 'Questo dominio appartiene a',
	'No One' => 'Nessuno',
	'Change' => 'Cambia',
	'Info for' => 'Informazioni per',
	'Delete this domain off the server' => 'Cancella questo dominio dal server',
	'Are you sure you wish to delete this domain' => 'Sei sicuro di voler cancellare questo dominio',
	'Created' => 'Creato',
	'Status' => 'Status',
	'ON' => 'ON',
	'Are you sure you wish to turn off hosting for this domain' => 'Sei sicuro di voler disattivare l\'hosting per questo domnio',
	'Turn OFF hosting for this domain' => 'Disattiva l\'hosting per questo dominio',
	'OFF' => 'OFF',
	'Turn ON hosting for this domain' => 'Attiva l\hosting per questo dominio',
	'Physical Hosting' => 'Hosting fisico',
	'View/Edit Physical hosting for this domain' => 'Visualizza/Modifica l\'hoting fisico per questo dominio',
	'edit' => 'modifica',
	'Redirect' => 'Redirect',
	'View/Edit where this domain redirects to' => 'Visualizza/Modifica per quali domini viene effettuato il redirect',
	'Alias of' => 'Alias per',
	'View/Edit what this domain is a server alias of' => 'Visualizza/Modifica quali nomi a dominio sono alias per',
	'No Hosting' => 'Nessun Hosting',
	'Setup hosting for this domain' => 'Impostazioni di hosting per questo dominio',
	'Go to the File Manager for this domain' => 'Vai al file manager per questo dominio',
	'The file manager is currently offline' => 'Il file manager � attualmente offline',
	'File Manager' => 'File Manager',
	'View/Edit Custom Error Documents for this domain' => 'Visualizza/Modifica i documenti per gli errori personalizzabili per questo dominio',
	'Error Documents' => 'Documenti per gli errori',
	'View/Edit Mail for this domain' => 'Visualizza/Modifica la Mail per questo dominio',
	'Mail' => 'Mail',
	'( off )' => '( off )',
	'View/Edit databases for this domain' => 'Visualizza/Modifica il database per questo dominio',
	'Databases' => 'I Database',
	'Manage DNS for this domain' => 'Manipola i DNS per questo dominio',
	'DNS Records' => 'Record DNS',
	'View Webstats for this domain' => 'Visualizza le statistiche web per questo dominio',
	'Webstats' => 'Statistiche Web',
	'Domain Usage' => 'Utilizzo del dominio',
	'Disk space usage' => 'Spazio usato su disco',
	'This month\'s bandwidth' => 'Banda mensile',
	'Illegal argument' => 'Argomento illegale',
	'Please enter the domain name you wish to setup' => 'Per favore inserisci il nome di dominio che vuoi impostare',
	'Invalid domain name. Please re-enter the domain name without the www.' => 'nome dominio non valido. Per favore ri-inserisci il nome a dominio sensa www.',
	'Invalid domain name. May only contain letters, numbers, dashes and dots. Must not start or end with a dash or a dot, and a dash and a dot cannot be next to each other' => 'nome dominio non valido. Pu� solo contentere lettere,numeri,apici e punti.non deve iniziare o finire con apici o punti,a un apici e un punto non possono essere prossimi uno con l\'altro',
	'Control Panel User' => 'Pannello di controllo utente',
	'Select One' => 'Selezionane uno',
	'Add domain' => 'Aggiungi dominio',
	'Add Domain' => 'Aggiungi Dominio',
	'Proceed to hosting setup' => 'Prosegui al setup dell\'hosting',
	'Add default DNS to this domain' => 'Aggiungi il DNS di default per questo dominio',
	'That email address already exists' => 'L\'indirizzo email gi� esiste',
	'Your passwords do not match' => 'Le tue password non combaciano',
	'You selected you wanted a redirect, but left the address blank' => 'Seleziona il redirect voluto,ma lascia l\'indirizzo vuoto',
	'Invalid password. Must only contain letters and numbers.' => 'Password non valida.Deve contentere solo caratteri e numeri',
	'The redirect list contains an invalid email address.' => 'La lista dei dei redirect contiene un indirizzo email non valido',
	'Invalid mailname. It may only contain letters, number, dashes, dots, and underscores. Must both start and end with either a letter or number.' => 'nome mail non valido. Non pu� contenere lettere,numeri,apici,punti,a sottolineature.Deve iniziare o finire necessariamente con una lettera o un numero.',
	'Mail is disabled for' => 'la Mail � disabilitata per',
	'. You can not add an email address for it.' => '. Non puoi aggiungere un indirizzo email per',
	'Edit' => 'Modifica',
	'mail' => 'mail',
	'Mail Name' => 'Nome Mail',
	'Confirm' => 'Conferma',
	'Mailbox' => 'Mailbox',
	'Mail will not be stored on the server if you disable this option. Are you sure you wish to do this?' => 'La mail non sar� salvata sul server se disabiliti questa opzione,Sei sicuro di voler fare questo?',
	'List email addresses here, seperate each with a comma and a space' => 'Elenca gli indirizzi email qui,separati uno dall\'altro da una virgola e uno spazio',
	'Add Mail' => 'Aggiungi Mail',
	'Update' => 'Aggiorna',
	'You must enter a name for this user' => 'Devi inserire un nome per questo utente',
	'You must enter a password for this user' => 'Devi inserire una password per questo utente',
	'Your password must be atleast 5 characters long, and not a dictionary word.' => 'La tua password deve essere almeno lunga 5 caratteri, a non deve essere una parola da dizionario',
	'The email address entered is invalid' => 'L\'indirizzo email non � valido',
	'info' => 'informazioni',
	'Full Name' => 'Nome completo',
	'Email Address' => 'Indirizzo EMail',
	'Edit Info' => 'Modifica info',
	'Proceed to Permissions Setup' => 'Procedi con l\'impostazione dei permessi',
	'Required fields' => 'Campi Richiesti',
	'Are you sure you wish to delete this user?' => 'Sei sicuro di voler cancellare questo utente?',
	'No custom error documents setup.' => 'Nessun Errore di default impostato',
	'Add Custom Error Document' => 'Aggiungi Un documento d\'errore di default',
	'Code' => 'Codice',
	'File' => 'File',
	'List HTTP Status Codes' => 'Elenca i codici di stato HTTP',
	'This server does not have' => 'Questo server non ha',
	'installed. Page cannot be displayed.' => 'installato.La pagina non pu� essere visualizzata',
	'Unable to connect to DB server! Attempting to restart mysql' => 'Impossibile connettersi al server DB!Rieseguire mysql',
	'Restart command completed. Please refresh the page.' => 'Rieseguire il comando completato. Per favore fare il refresh della pagina',
	'If the problem persists, contact the system administrator' => 'Se il problema persiste, contatta l\'amministratore di sistema',
	'You are not authorized to view this page' => 'Non sei autorizzato a vedere questa pagina',
	'List control panel users' => 'Elenco degli utenti del pannello di controllo',
	'Users' => 'Utenti',
	'List domains' => 'Elenco dominii',
	'Domains' => 'Domini',
	'List email addresses' => 'Elenco indirizzi email',
	'List databases' => 'Elenco database',
	'DNS for domains on this server' => 'DNS per i domnini su questo server',
	'DNS' => 'DNS',
	'Manage system settings' => 'Modifica i settaggi di sistema',
	'System' => 'Sistema',
	'Goto main server index page' => 'Vai alla pagina di indice principale del server',
	'Main Menu' => 'Menu Principale',
	'List your domains' => 'Elenca i tuoi domnini',
	'My Domains' => 'I mie domini',
	'List all your email accounts' => 'Elenca tutti i tuoi account email',
	'My email accounts' => 'I miei account email',
	'Logout' => 'Esci',
	'Are you sure you wish to logout?' => 'Sei sicuro di voler uscire?',
	'Are you sure you wish to delete hosting for this domain?' => 'Sei sicuro di voler cancellare l\'hosting per questo dominio?',
	'delete hosting' => 'cancella hosting',
	'www prefix' => 'prefisso www',
	'Yes' => 'Si',
	'No' => 'No',
	'FTP Username' => 'FTP Username',
	'FTP Password' => 'FTP Password',
	'Shell' => 'Shell',
	'SSL Support' => 'SSL Support',
	'If you disable ssl support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Se disabiliti il supporto ssl,non sarai pi� in grado di ripristinarlo .sei sicuro di volerlo fare?',
	'PHP Support' => 'Supporto PHP',
	'If you disable php support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Se disabiliti il supporto php,non sarai pi� in grado di ripristinarlo .sei sicuro di volerlo fare?',
	'CGI Support' => 'Supporto CGI',
	'If you disable cgi support, you will not be able to enable it again.\\rAre you sure you wish to do this?' => 'Se disabiliti il supporto cgi,non sarai pi� in grado di ripristinarlo .sei sicuro di volerlo fare?',
	'Directory indexing' => 'Indicizzo Directory',
	'This domain is an alias of' => 'Questo dominio � un\' alias per',
	'Host on this server' => 'Ha l\'host su questo server',
	'Redirect to another domain' => 'esegue il redirect su un\'altro dominio ',
	'Show contents of another site on this server' => 'Mostra i contenuti di un\'altro sito su questo server',
	'Continue' => 'Continua',
	'Are you sure you wish to delete this log file?' => 'Sei sicuro di voler cancellare questo file di log',
	'Log files for' => 'Log files per',
	'Manage' => 'Manipola',
	'Go to log rotation manager for' => 'Vai al manager per la rotazione dei log',
	'Log Rotation' => 'Rotazione Log',
	'Log Name' => 'Nome Log',
	'Compression' => 'Compressione',
	'File Size' => 'Dimensione File',
	'Download the' => 'Scarica la',
	'Custom log rotation for' => 'Personalizzazione della rotazione log',
	'is' => '�',
	'Are you sure you wish to turn off the custom log rotation for' => 'Sei sicuro di voler disattivare la rotazione log per',
	'Turn OFF log rotation for' => 'Disattiva la rotazione log per',
	'Turn ON log rotation for' => 'Attiva la rotazione log per',
	'You must choose how many log files you wish to keep!' => 'Devi decidere quanti file di log desideri tenere! ',
	'You must make a rotation selection: filesize, date, or both' => 'Devi creare una selezione sulla rotazione: dimensione file, data, entrambi',
	'Keep' => 'Tieni',
	'log files' => 'file di log',
	'Rotate by' => 'Ruotato da',
	'Filesize' => 'Dimensione File',
	'Date' => 'Data',
	'Daily' => 'Giornalmente',
	'Weekly' => 'Settimanalmente',
	'Monthly' => 'Mensilmente',
	'Email about-to-expire files to' => 'l\'Email sta scadendo ',
	'Compress log files' => 'file log Compressi',
	'No domains setup, so there are no Log files' => 'Nessun dominio settato,cos� nessun file di log',
	'Please Login' => 'Per favore eseguire il login',
	'Username' => 'Username',
	'Language' => 'Linguaggio',
	'English' => 'Inglese',
	'Your login is secure' => 'Il tuo login � sicuro',
	'Go to Secure Login' => 'Esegui il login sicuro',
	'Goto' => 'Vai a ',
	'Turn ON mail for' => 'Attiva l\'email per',
	'Turn OFF mail for' => 'Disattiva l\'email per',
	'Are you sure you wish to disable mail for this domain?' => 'Sei sicuro di voler disabilitare le mail per questo dominio',
	'Mail sent to email accounts not set up for this domain ( catchall address )' => '',
	'Send to' => 'Inviate a',
	'Bounce with' => 'Ritorno con',
	'Delete it' => 'Canellalo',
	'Forwoard to that user' => 'Reinvia a quell\' utente',
	'You need at least two domains in the account with mail turned on to be able to alias mail' => 'Devi avere almeno due domini con l\'email account attivato per essere in grado di fare alias sulle mail',
	'No mail for this domain.' => 'Nessuna email per questo dominio',
	'Mail for this domain' => 'Mail per questo dominio',
	'Webmail' => 'Webmail',
	'Webmail is currently offline' => 'Webmail attualmente offline',
	'offline' => 'offline',
	'If you delete this email, you may not be able to add it again.\\rAre you sure you wish to do this?' => 'Se cancelli questa mail, potresti non poterla attuivare pi�.\\rSei sicuro di volerlo fare?',
	'Are you sure you wish to delete this email?' => 'Sei sicuro di voler cancellare questa mail',
	'This user is only allowed to create' => 'Questo utente � solo permesso di creare',
	'email accounts. Are you sure you want to add another?' => 'account email.Sei sicuro di volerne aggiungere un\'altro',
	'Add an email account' => 'Aggiungi un account email',
	'You have no domains setup.' => 'Non hai domini impostati',
	'Create a new email account' => 'Crea un nuovo account email',
	'Add an email address' => 'Aggiungi un indirizzo email',
	'There are no mail users setup' => 'Non ci sono utenti con mail impostate',
	'Email Addresses' => 'Indirizzi Email',
	'Service' => 'Servizi',
	'Running' => 'Esecuzione',
	'Start' => 'Inizio',
	'Stop' => 'Ferma',
	'Restart' => 'Riesegui',
	'IP Address' => 'Indirizzi IP',
	'Session Time' => 'Tempo di Sessione',
	'Idle Time' => 'Temo di Idle',
	'Remove' => 'Rimuovi',
	'Stop/Start system services such as httpd, mail, etc' => 'Fermo/Inizio dei servizi di sistema come httpd,mail,etc',
	'System Services' => 'Servizi di sistema',
	'View who is logged into the server, and where from' => 'Visualizza chi � loggato sul server,e da dove',
	'Login Sessions' => 'Sessioni di Login',
	'Services that automatically start when the server boots up' => 'Servizi che si startano automaticamente al boot del server',
	'Startup Services' => 'Servizi di Startup',
	'The DNS records that are setup for a domain by default when one is added to the server' => 'I record DNS che sono impostati per un dominio di default quando uno viene aggiunto sul server',
	'Default DNS' => 'DNS di default',
	'Change the admin password' => 'Cambia la password di admin',
	'Change Admin Password' => 'Cambia la Admin Password',
	'Load phpMyAdmin for all with MySQL admin user' => 'Carica phpMyAdmin per tutti gli utenti MySQL',
	'Admin MySQL Databases' => 'Admin MySQL Databases',
	'View general system information' => 'Visualizza le informazioni generali del sistema',
	'System Info' => 'Info di Sistema',
	'View output from the phpinfo() function' => 'Visualizza l\'output dalla funzione phpinfo()',
	'PHP Info' => 'PHP Info',
	'View Mail Queue' => 'Visualizza la coda Email',
	'Are you sure you wish to reboot the system?' => 'Sei sicuro di voler eseguire il reboot del server',
	'Reboot the server' => 'Reboot del server',
	'Reboot Server' => 'Reboot Server',
	'You are about to shutdown the system. There is no way to bring the server back online with this software. Are you sure you wish to shutdown the system?' => 'Tu stai spegnendo il sistema.Non si pu� riportare in nessun modo ON il server tramite questa applicazione.Sei sicuro di voler spegnere il server',
	'Shutdown the server' => 'Spegnimento del server',
	'Shutdown Server' => 'Spegnimento Server',
	'This user can' => 'Questo utente pu�',
	'Create' => 'Creare',
	'Note: A negative limit mean unlimited' => 'Nota: un limite negativo significa illimitato',
	'You can\'t add domains' => 'Non puoi aggiungere domini',
	'You can\'t add databases' => 'Non puoi aggiungere database',
	'You can\'t add cron jobs' => 'Non puoi aggiungere cron jobs',
	'You can\'t add email addresses' => 'Non puoi aggiungere indirizzi email',
	'You can\'t add DNS records' => 'Non puoi aggiungere record dns',
	'You can\'t add cgi to hosting on any domains' => 'Non puoi aggiungere cgi per ogni dominio in hosting',
	'You can\'t add php to hosting on any domains' => 'Non puoi aggiungere php per ogni dominio in hosting',
	'You can\'t add ssl to hosting on any domains' => 'Non puoi aggiungere ssl per ogni dominio in hosting',
	'You can\'t add shell users' => 'Non puoi aggiungere una shell utente',
	'There are no users setup' => 'Non ci sono utenti impostati',
	'View user data for' => 'Visualizza i dati utente per',
	'Add a user to the control panel' => 'Aggiungi un utente al pannello di controllo',
	'Add a Control Panel user' => 'Aggiungi un utente al pannello di controllo',
	'User does not exist' => 'L\'utente non esiste ',
	'This user is locked out due to failed login attempts' => 'Questo utente � bloccato poich� ha fallito molti tentativi sulla procedura di login',
	'Unlock' => 'Sbloccato',
	'Company' => 'Compagnia',
	'Contact email' => 'Contatto email',
	'Login ID' => 'ID di Login',
	'Edit account info' => 'Modifica le informazioni account',
	'See what you can and can not do' => 'Vedi cosa voi e non puoi fare',
	'View/Edit Permissions' => 'Visualizza/Modifica Permessi',
	'View Permissions' => 'Visualizza Permessi',
	'Options' => 'Opzioni',
	'You have no domains setup' => 'Non hai domini impostati',
	'No domains setup' => 'Nessun dominio impostato',
	'For which domain' => 'Per quale dominio',
	'Back' => 'Ritorna',
	'Add a MySQL database' => 'Aggiungi un  database MySQL',
	'Add E-Mail Account' => 'Aggiungi un account email',
	'Add/Edit DNS records' => 'Aggiungi/Modifica un record DNS',
	'View Webstatistics' => 'Visualizza le statistiche web',
	'List all of your domain names' => 'Elenca tutti i tuoi nomi a domino',
	'List Domains' => 'Elenco Domini',
	'This user is at his/her domain limit' => 'Questo utente � al limite',
	'Add one anyway' => 'Aggiungi uno comunque',
	'Domain usage' => 'Utilizzo Dominio',
	'Traffic usage (This month)' => 'Utilizzo Traffico (Questo Mese)',
	'is not setup for physical hosting. Webstats are not available' => 'Non � impostato per hosting fisico.Statistiche Web non utilizzabili',
	'OK' => 'OK',
	'SSH Terminal' => 'Terminale SSH'

	);

?>
