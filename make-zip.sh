#!/bin/bash
if [ ! -z "$1" ] 
then
    if [ -d "$1" ]
    then
        atomium_dir="$1/atomium"
        atomium_zip="$1/atomium.zip"
        atomium_runtime="$atomium_dir/runtime"
        atomium_assets="$atomium_dir/web/assets"
        atomium_git="$atomium_dir/.git"
        atomium_schedule="$atomium_dir/config/schedule.php"
        atomium_docker_zip="$atomium_dir/docker/atomium.zip"
        if [ ! -d "$atomium_dir" ]
        then
            if [ -f "$atomium_zip" ]
            then
                rm -f $atomium_zip
            fi
            cp -r ../atomium $atomium_dir
            rm -fR $atomium_runtime/*
            rm -fR $atomium_assets/*
            rm -fR $atomium_git
            rm -f $atomium_schedule
            rm -f $atomium_docker_zip
            cd $1
            zip -r atomium.zip atomium
            rm -fR $atomium_dir
        else
            echo "Directory atomium already exists in $1. Please delete it and call script again"
        fi
    else
        echo "Destination directory is not valid."
    fi
else 
    echo "Please pass destination folder for ZIP archive."
fi