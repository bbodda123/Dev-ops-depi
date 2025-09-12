#!/bin/bash
shopt -s expand_aliases

sudo adduser test
sudo deluser test

rm -f One.txt
touch One.txt

mkdir folder

chmod 750 One.txt
chmod u=rwx,g=r-x,o=--- One.txt

mkdir dirOne
rm -rf dirOne

find One.txt

alias show='cat One.txt'
show

unalias show

date >> One.txt

pwd

mv One.txt folder
cp scriptOne.sh folder
mv folder folderModefied

rm -rf folderModefied

echo "Script Have Succesfully Ran "
sudo su hima
