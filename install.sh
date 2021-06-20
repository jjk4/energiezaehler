#!/bin/bash
#Farben Konfigurieren
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[1;36m'
NC='\033[0m'
#Prüfen ob user root ist
if [ "$EUID" -ne 0 ]
	then echo -e "${RED}Bitte führe das Skript als root aus${NC}"
	exit
fi

#Willkommensnachricht
echo -e "${GREEN}Herzlich Willkommen beim Energiezähler!${NC}"

#Prüfen, ob der Nutzer die SOftware installieren will
read -p "$(echo -e "${BLUE}Möchtest du den Energiezähler jetzt installieren? [y/N] ${NC}")" installation
if [ -z $installation ]
then
	installation="N"
fi
if [ $installation != 'y' ]
then
	echo -e "${RED}Installation wurde abgebrochen${NC}"
	exit
fi
#Grundeinstellungen Variablen
read -p "$(echo -e "${BLUE}In welchem Ordner soll sich der Energiezähler befinden? (Standard: /energie) ${NC}")" installationpath
if [ -z $installationpath ]
then
	installationpath="/energie"
fi
read -p "$(echo -e "${BLUE}Soll eine lokale oder entfernte Datenbank verwendet werden? [lokal/entfernt] (Standard: lokal) ${NC}")" databasetype
if [ -z $databasetype ]
then
	databasetype="lokal"
fi
if [ $databasetype == 'entfernt' ]
then
	read -p "$(echo -e "${BLUE}Gib die IP oder den Hostname des Servers der Datenbank ein ${NC}")" host
	read -p "$(echo -e "${BLUE}Gib den Port des Servers der Datenbank ein ${NC}")" port
	read -p "$(echo -e "${BLUE}Erstelle auf dem Server eine Datenbank und gib den Namen der Datenbank ein ${NC}")" database
	
else
	host="localhost"
	port="8086"
	databasetype="lokal"
	read -p "$(echo -e "${BLUE}Wie soll die Datenbank heißen? (Standard: energie)${NC}")" database
	if [ -z $database ]
	then
		database="energie"
	fi
fi
#Installation starten
echo -e "${GREEN}Installiere Abhängigkeiten...${NC}"
apt-get install git sudo python3-pip
pip3 install minimalmodbus
pip3 install influxdb
echo -e "${GREEN}Installiere Webserver...${NC}"
apt-get install apache2 php -y
echo -e "${GREEN}Lade Energiezähler herunter...${NC}"
git clone https://github.com/jjk4/energiezaehler.git /var/www/html$installationpath
echo -e "${GREEN}Richte Energiezähler ein...${NC}"
chown -R www-data:www-data /var/www/html$installationpath
chmod 775 -R /var/www/html$installationpath
touch /etc/cron.d/energiezaehler
chown root:root /etc/cron.d/energiezaehler
chmod 755 /etc/cron.d/energiezaehler
usermod -a -G dialout www-data
if [ $databasetype != 'entfernt' ]
then 
	echo -e "${GREEN}Installiere Datenbank...${NC}"
	apt-get install influxdb
fi
echo -e "${GREEN}Richte Datenbank ein...${NC}"
cd /var/www/html$installationpath/
sudo -u www-data php installation.php $host $port $database "/var/www/html$installationpath"
echo -e "${GREEN}Das wars. Dein Energiezähler ist jetzt betriebsbereit. Schau dir doch vor der Nutzung noch das Wiki unter https://github.com/jjk4/energiezaehler/wiki an. Bei Problemen kannst du gerne einen Issue unter https://github.com/jjk4/energiezaehler/issues erstellen. Viel Spaß!${NC}"
