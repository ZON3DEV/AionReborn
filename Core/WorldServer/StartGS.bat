@echo off
TITLE AionReborn: World Server Monitor
@COLOR 4B
SET PATH="..\..\Tools\Java\bin"

:START
CLS

echo.

echo Starte World Server um %TIME%

echo.

REM -------------------------------------
REM Default parameters for a basic server.
java -Xms2048m -Xmx4096m -XX:MaxHeapSize=4096m -Xdebug -XX:MaxNewSize=48m -XX:NewSize=48m -XX:+UseParNewGC -XX:+CMSParallelRemarkEnabled -XX:+UseConcMarkSweepGC -XX:-UseSplitVerifier -ea -javaagent:./libs/al-commons-2.0.jar -cp ./libs/*;./libs/AL-Game.jar com.aionemu.gameserver.GameServer
REM -------------------------------------
SET CLASSPATH=%OLDCLASSPATH%

if ERRORLEVEL 2 goto restart
if ERRORLEVEL 1 goto error
if ERRORLEVEL 0 goto end

REM Restart...
:restart
echo.
echo Administrator Restart ...
echo.
goto start

REM Error...
:error
echo.
echo Server terminated abnormaly ...
echo.
goto end

REM End...
:end
echo.
echo Server terminated ...
echo.
pause