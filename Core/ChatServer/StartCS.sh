#!/bin/sh

err=1
until [ $err == 0 ];
do
	java -Xms128m -Xmx256m -ea -Xbootclasspath/p:./libs/jsr166.jar -cp ./libs/*:AL-Chat.jar com.aionemu.chatserver.ChatServer
	err=$?
done
