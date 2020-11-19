#!/bin/bash

myvariable=$(echo "SELECT swip FROM swzoznam" | mysql mrtgadmin -u admin -padmin)
#myvariable= grep -e "swip" $myvariable

function strip {
    local STRING=${1#$"$2"}
    echo ${STRING%$"$2"}
}


echo 'IP=('$(strip "$myvariable" "swip")');' > /script/IP
