#!/bin/bash

rm -f boda
touch boda.txt
ls -la

rm -rf dirOne
mkdir dirOne
ls -la

mv boda.txt dirOne/
cat dirOne/boda.txt

echo "The File Have Moved Correctelly!! " >> dirOne/boda.txt
chmod 750 dirOne
chmod 750 dirOne/boda.txt

ls -la dirOne/
