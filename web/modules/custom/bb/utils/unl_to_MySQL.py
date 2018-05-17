#!/usr/bin/python
# vim: set fileencoding=utf-8 :
import csv
import os
import time

def log(msg):
    with open("/home/nico/unl_to_csv/daily.log", "a") as f:
        f.write(msg)


def unl_to_csv(filename, nb_rows):
  """
  Transforme filename.unl en csv injectable dans MySQL.

  La fonction cree deux fichiers :
  filename.csv : fins de ligne en \r non lisible sous vi
  filenameHuman.csv : fins de ligne en \n lisible sous vi

  :filename: titre du fichier a traiter : ex. gmodu
  :nb_rows:  nombre de colonnes du fichier a traiter
  """
  fname = "/home/nico/unl_to_csv/"+filename+".unl"
  try:
    #  file = open(fname, "rb")
    file = open(fname, "r")
  except:
    str = "%s ERROR ouverture fichier unl\n" %(filename)
    print(str)
    log(str)
    return False

  try:
    reader = csv.reader(file, delimiter='|', quoting=csv.QUOTE_NONE)
    row_prec = []
    new_reader = []
    i=0
    for row in reader:
      i=i+1
      if len(row_prec)!=0:
        #  print i," ! ",len(row),row[0],row[1]
        """ row_prec=["A","B",""] row=["C","D",""]        """
        row_prec.pop(-1)
        """ row_prec=["A","B"]    row=["C","D",""]        """
        row[0] = row_prec[-1]+" "+row[0]
        """ row_prec=["A","B"]    row=["B C","D",""]      """
        row_prec.pop(-1)
        """ row_prec=["A"]         row=["B C","D",""]     """
        row = list(row_prec + row)
        """ row_prec=["A"]         row=["A","B C","D",""] """
        row_prec = []
        """ row_prec=[]            row=["A","B C","D",""] """

      if len(row) == nb_rows+1:
	#  print i,len(row),row[0],row[1]
        new_reader.append(row)
        row_prec = []
      else:
	#  print i,len(row),row[0],row[1]
        row_prec = list(row)
  except:
    str = "%s ERROR sur le reader csv\n" %(filename)
    print(str)
    log(str)
    return False
  finally:
    file.close()

  fname = "/home/nico/unl_to_csv/"+filename+".csv"
  #  file = open(fname, "wb")
  file = open(fname, "w")
  try:
    writer = csv.writer(file,delimiter=",",quoting=csv.QUOTE_NONNUMERIC,quotechar = '\"', escapechar = "\"",lineterminator="\r")
    for row in new_reader:
      assert len(row)==nb_rows+1
      """ row=["A","B C","D",""] """
      writer.writerow(row[:-1])
  except AssertionError:
    str = "%s ERROR longueur sur .csv\n" %(filename)
    print(str)
    log(str)
    return False
  finally:
    file.close()

  fname = "/home/nico/unl_to_csv/"+filename+"Human.csv"
  #  file = open(fname, "wb")
  file = open(fname, "w")
  try:
    writer = csv.writer(file,delimiter=",",quoting=csv.QUOTE_NONNUMERIC,quotechar = '\"', escapechar = "\"",lineterminator="\n")
    for row in new_reader:
      assert len(row)==nb_rows+1
      """ row=["A","B C","D",""] """
      writer.writerow(row[:-1])
  except AssertionError:
    str = "%s ERROR de longueur sur Human.csv\n" %(filename)
    print(str)
    log(str)
    return False
  finally:
    file.close()

  return True

def injection(filename):
  """
  Injecte csvfile dans la table dbtable.

  Le nom csvfile est construit a partir de filename
  Le nom dbtable est construit a partir de filename
  """
  dbtable = "gbb_%s" % (filename)
  csvfile = "/home/nico/unl_to_csv/%s.csv" % (filename)
  options = "CHARACTER SET UTF8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r'"

  import MySQLdb
  connection = MySQLdb.Connect(host='localhost', user='root', passwd='#cdoo1c9?', db='bb8pp')
  cursor = connection.cursor()
  query = "TRUNCATE %s" % (dbtable)
  cursor.execute( query )
  query = "LOAD DATA LOCAL INFILE '%s' IGNORE INTO TABLE %s %s" % (csvfile,dbtable,options)
  try:
      cursor.execute( query )
      connection.commit()
  except MySQLdb.Error as e:
      connection.rollback()
      str = "%s ERROR MySQL sur bb8pp : %s\n" %(filename,str(e))
      print(str)
      log(str)
      return False
  finally:
      cursor.close()
      connection.close()

  connection = MySQLdb.Connect(host='localhost', user='root', passwd='#cdoo1c9?', db='bb')
  cursor = connection.cursor()
  query = "TRUNCATE %s" % (dbtable)
  cursor.execute( query )
  query = "LOAD DATA LOCAL INFILE '%s' IGNORE INTO TABLE %s %s" % (csvfile,dbtable,options)
  try:
      cursor.execute( query )
      connection.commit()
  except MySQLdb.Error as e:
      connection.rollback()
      str = "%s ERROR MySQL sur bb : %s\n" %(filename,str(e))
      print(str)
      log(str)
      return False
  finally:
      cursor.close()
      connection.close()
  return True

def check(filename,nb_rows):

  try:
      nbs = os.path.getmtime("/home/gaia/martine/"+filename+".unl")
      ftime = time.strftime("%d/%m/%Y-%H:%M:%S",time.gmtime(nbs))
      fdate = time.strftime("%d/%m/%Y",time.gmtime(nbs))
      if fdate != time.strftime("%d/%m/%Y") : return False
      size = os.path.getsize("/home/gaia/martine/"+filename+".unl")

      fname = "/home/nico/unl_to_csv/"+filename+"Human.csv"
      #  file = open(fname, "rb")
      if os.path.getsize(fname) < 2:
          str = "%s ERROR fichier vide\n" %(filename)
          print(str)
          log(str)
          return False
      file = open(fname, "r")
      reader = csv.reader(file)
      for row in reader:
          if (len(row)!=nb_rows):
            str = "%s ERROR verification des colonnes\n" %(filename)
            print(str)
            log(str)
            return False
      #  file = open(fname, "rb")
      file = open(fname, "r")
      reader = csv.reader(file)
      row_count = sum(1 for row in reader)

      str = "%s  %s %8s bytes  %5s lignes %2s cols\n" %(filename,ftime,size,row_count,nb_rows)
      print(str)
      log(str)
  except:
      return False

  return True

"""
La base de donnees et les tables devraient avoir characterset et collation UTF8
ALTER DATABASE AFAC_gaia CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE gbb_gmodu CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
"""

# write daily.log header
with open("/home/nico/unl_to_csv/daily.log", "w") as f:
    f.write(time.strftime("%d/%m/%Y-%H:%M:%S")+"\n")
    f.write("-------------------\n")

files = dict(
        gmodu=39,
        gdisp=28, gdire=5,
        gmoof=38, gdiof=25,
        gmofl=4,gresp=17,
        ntcan=5, norie=5,
        ncamp=6, ncont=5,
        netab=24, nmoda=5,
        nprac=5, nprna=5)

for file,col in files.items():
  if unl_to_csv(file,col):
      if check(file,col):
          injection(file)

# write daily.log footer
tim = time.strftime("%d/%m/%Y-%H:%M:%S")
with open("/home/nico/unl_to_csv/daily.log", "a") as f:
    f.write("-> "+time.strftime("%d/%m/%Y-%H:%M:%S"))
    f.write("\n\n")
