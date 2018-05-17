#!/bin/bash
opt=`getopt :nspgmre: $*`; statut=$?
# Si une option invalide a été trouvée
echo "Usage: `basename $0` [-n nettoyage] [-s sauvegarde BDD] [-g get fichiers unl] [-m mysqlInjections] [-r rapport par email]"

WEB="/var/www/html/bb"
HOME="/home/nico/unl_to_csv"
SCPDIR="/home/gaia/martine"
source $HOME/bb-include.sh

if test $statut -ne 0; then
  echo "Pour tout lancer : ./`basename $0` -nsgm"
  exit $statut
fi

# Traitement de chaque option du script
set -- $opt
while true
do
  # Analyse de l'option reçue - Chaque option sera effacée ensuite via un "shift"
  case "$1" in
    ## **************************************************
    -n) ## * -n * nettoyage
    ## **************************************************
    echo "_N_etttoyage du dossier"
    cd $HOME && for i in *.unl.OLD ; do mv $i $i.OLD ; done
    cd $HOME && for i in *.unl ; do mv $i $i.OLD ; done
    shift;;
    ## **************************************************
    -s) ## * -s * sauvegarde de la base précédente
    ## **************************************************
    echo "_S_auvegarde de la BDD dans BDD_BKP"
    cd $HOME && mv database_bkp.sql database_bkp.sql.OLD
    /usr/bin/mysql --user=root --password=$BDDPW -e "DROP DATABASE $BDDBKP;"
    /usr/bin/mysql --user=root --password=$BDDPW -e "CREATE DATABASE $BDDBKP;"
    /usr/bin/mysqldump --user=root --password=$BDDPW $BDD > $HOME/database_bkp.sql
    /usr/bin/mysql --user=root --password=$BDDPW $BDDBKP < $HOME/database_bkp.sql
    cd $WEB && su - www-data /usr/local/bin/drush8 bam-backup
    cd $WEB && su - www-data /usr/local/bin/drush8 bam-backup db manual GAIA
    cd $WEB && su - www-data /usr/local/bin/drush8 bam-backup db manual BBdata
    shift;;
    ## **************************************************
    -g) ## * -g * recuperation des donnees
    ## **************************************************
    echo "_G_et donnees"
    cp -p $SCPDIR/*.unl $HOME
    shift;;
    ## **************************************************
    -m) ## * -m * Injections MySQL après amélioration des données
    ## **************************************************
    echo "_M_YSQL injections après amélioration des données"
    python $HOME/unl_to_MySQL.py
    shift;;
    ## **************************************************
    -r) ## * -r * rapports par mail + history
    ## **************************************************
    echo "_R_apport par email + history"
    cat $HOME/daily.log >> $HOME/history.log
    if grep -q "ERROR" $HOME/daily.log
    then
      /usr/bin/mail -s "$(echo -e "ECHEC BB NG")" nicolas.poulain@ac-paris.fr jean-pierre.charpentrat@ac-paris.fr Isabelle.Cordier@ac-paris.fr christian.muir@ac-paris.fr franck.valadoux@ac-paris.fr < $HOME/daily.log
    else
      /usr/bin/mail -s "$(echo -e "SUCCES BB NG")" nicolas.poulain@ac-paris.fr jean-pierre.charpentrat@ac-paris.fr Isabelle.Cordier@ac-paris.fr christian.muir@ac-paris.fr franck.valadoux@ac-paris.fr < $HOME/daily.log
    fi
    shift;;
  --) # Fin des options - Sortie de boucle
    shift; break;;
esac
done
# Affichage du reste des paramètres s'il y en a
test $# -ne 0 && echo "Il reste encore $# paramètres qui sont $*" || echo "Il n'y a plus de paramètre"

