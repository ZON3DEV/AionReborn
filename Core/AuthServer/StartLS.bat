@ECHO off
TITLE AionReborn: Authentication Server Monitor
@COLOR 1A
SET PATH="..\..\Tools\Java\bin"

:start
CLS
echo.

echo Starte Authentication Server um %TIME%
echo.
REM -------------------------------------
REM Default parameters for a basic server.
java -Xms64m -Xmx128m -server -cp ./libs/*;AL-Login.jar com.aionemu.loginserver.LoginServer
REM
REM -------------------------------------

SET CLASSPATH=%OLDCLASSPATH%

if ERRORLEVEL 1 goto error
goto end
:error
echo.
echo Login Server Terminated Abnormaly, Please Verify Your Files.
echo.
:end
echo.
echo Login Server Terminated.
echo.
pause