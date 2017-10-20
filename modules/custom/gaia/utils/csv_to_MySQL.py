#!/usr/bin/python
# vim: set fileencoding=utf-8 :
import csv

def injection(filename):
  """
  Injecte csvfile dans la table dbtable.

  Le nom csvfile est construit a partir de filename
  Le nom dbtable est construit a partir de filename
  """
  from globals import *

  dbtable = "gbb_%s" % (filename)
  csvfile = "/var/lib/mysql-files/%s.csv" % (filename)
  options = "FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r'"

  import MySQLdb

  # COMMENTAIRE SUIVANTE A EFFACER AVANT GIT PUSH !!!!!!!!!!!!!
  #  connection = MySQLdb.Connect(host='localhost', user='root', passwd='coreI7', db='AFAC_gaia')

  connection = MySQLdb.Connect(host, user, passwd, db)
  cursor = connection.cursor()

  query = "TRUNCATE %s" % (dbtable)
  cursor.execute( query )
  query = "LOAD DATA INFILE '%s' IGNORE INTO dbTABLE %s %s" % (csvfile,dbtable,options)
  print("***************************************")
  print("*********** %s *********************" % (filename))
  print("***************************************")
  cursor.execute( query )
  connection.commit()

"""
A FAIRE UNE FOIS !
La base de donnees et les tables devraient avoir characterset et collation UTF8
ALTER DATABASE AFAC_gaia CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE gbb_gmodu CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

A CHAQUE FOIS
ALTER TABLE `gbb_gmodu` ADD `mid` INT(50) NOT NULL FIRST;
UPDATE gbb_gmodu SET mid = CONCAT(co_modu,co_degre)

"""

from globals import *

for table, nb_rows in list.items():
    injection(table)
