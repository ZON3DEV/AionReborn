@ECHO OFF
TITLE TrinityCore: Datenbank Installation
COLOR 0B
Copy /b mysql.rn mysql.exe
CLS
ECHO ####################################################################################
ECHO.
ECHO.
ECHO		Mit diesem Skript kann die WorldDB installiert werden.
ECHO		Wenn Du nicht sicher bist in welchem Verzeichnis die
ECHO		MySQL.exe zu finden ist, dann gib bei der Frage danach
ECHO		lediglich ".\" ein. Stelle vor der Installation sicher
ECHO		das die Datenbank existiert da es andernfalls zu einem
ECHO		Fehler kommt. Mit einer beliebigen Taste geht es nun
ECHO		zur Installation.
ECHO.
ECHO.
ECHO ####################################################################################
ECHO.
ECHO.
ECHO.
ECHO.
PAUSE
GOTO MYSQL

:MYSQL
CLS
ECHO.
ECHO		Pfad zur MySQL Installation
ECHO.
SET /P mysql="MySQL: "
GOTO HOST

:HOST
CLS
ECHO.
ECHO		MySQL: %mysql%
ECHO.
ECHO		MySQL Server IP
ECHO.
SET /P svr="Host: "
GOTO USER

:USER
CLS
ECHO.
ECHO		 MySQL: %mysql%
ECHO		Server: %svr%
ECHO.
ECHO		MySQL Benutzername
ECHO.
SET /P user="Benutzer: "
GOTO PASS

:PASS
CLS
ECHO.
ECHO		   MySQL: %mysql%
ECHO		  Server: %svr%
ECHO		Benutzer: %user%
ECHO.
ECHO		MySQL Passwort
ECHO.
SET /P pass="Passwort: "
GOTO PORT

:PORT
CLS
ECHO.
ECHO		   MySQL: %mysql%
ECHO		  Server: %svr%
ECHO		Benutzer: %user%
ECHO		Passwort: %pass%
ECHO.
ECHO		MySQL Server Port
ECHO.
SET /P port="Port: "
GOTO DB

:DB
CLS
ECHO.
ECHO		   MySQL: %mysql%
ECHO		  Server: %svr%
ECHO		Benutzer: %user%
ECHO		Passwort: %pass%
ECHO		    Port: %port%
ECHO.
ECHO		World Datenbank
ECHO.
SET /P wdb="Datenbank: "
GOTO INSTALL

:INSTALL
for %%i in (..\..\Core\Worldserver\sql\*.sql) do echo . Installiere %%i & %mysql%\mysql -q -s -h %svr% --user=%user% --password=%pass% --port=%port% %wdb% < %%i
ECHO.
ECHO.
ECHO	      Datenbank wurde installiert...
ECHO.
ECHO.
PAUSE
del mysql.exe
