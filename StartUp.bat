@ECHO off

CLS

CD Core\AuthServer
start ..\AuthServer\StartLS
CD ..\WorldServer
start StartGS
CD ..\ChatServer
start StartCS
)
