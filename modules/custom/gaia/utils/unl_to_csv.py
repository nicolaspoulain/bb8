#!/usr/bin/python
# vim: set fileencoding=utf-8 :
import csv

def unl_to_csv(filename, nb_rows):
  """
  Transforme filename.unl en csv injectable dans MySQL.

  La fonction cree deux fichiers :
  filename.csv : fins de ligne en \r non lisible sous vi
  filenameHuman.csv : fins de ligne en \n lisible sous vi

  :filename: titre du fichier a traiter : ex. gmodu
  :nb_rows:  nombre de colonnes du fichier a traiter
  """
  fname = filename+".unl"
  file = open(fname, "rb")

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
  finally:
    file.close()

  fname = filename+".csv"
  file = open(fname, "wb")
  try:
    writer = csv.writer(file,delimiter=",",quoting=csv.QUOTE_NONNUMERIC,quotechar = '\"', escapechar = "\"",lineterminator="\r")
    for row in new_reader:
      assert len(row)==nb_rows+1
      """ row=["A","B C","D",""] """
      writer.writerow(row[:-1])
  except AssertionError:
    print("Erreur de longueur",i)
  finally:
    file.close()

  fname = filename+"Human.csv"
  file = open(fname, "wb")
  try:
    writer = csv.writer(file,delimiter=",",quoting=csv.QUOTE_NONNUMERIC,quotechar = '\"', escapechar = "\"",lineterminator="\n")
    for row in new_reader:
      assert len(row)==nb_rows+1
      """ row=["A","B C","D",""] """
      writer.writerow(row[:-1])
  except AssertionError:
    print("Erreur de longueur",i)
  finally:
    file.close()

from globals import *

for table, nb_rows in table_list.items():
    #  unl_to_csv(table,nb_rows)
    print(table,nb_rows)


