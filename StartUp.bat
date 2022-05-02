REM Mit diesem Skript starten alle drei Server mit einem Klick
@ECHO off

CLS

CD Core\AuthServer
start ..\AuthServer\StartLS
CD ..\WorldServer
start StartGS
CD ..\ChatServer
start StartCS
)
