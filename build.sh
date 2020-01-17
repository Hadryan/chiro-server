#!/bin/bash

docker build -t 2hamed/chiro-api .

getopts ":p" publish
if [[ $publish == "p" ]]; then
    docker push 2hamed/chiro-api
fi