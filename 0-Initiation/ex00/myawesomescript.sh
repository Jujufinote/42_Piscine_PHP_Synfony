#!/bin/sh

curl -s -o /dev/null -w "%{url_effective}\n" -L $1

# -s makes curl silent during downloading
# -o gives an output for the results, /dev/null is a blackhole for Linux, every data put is erased instantly
# -w indicates the use of internal variables next to curl, url_effective is the final url after all redirections
# -L authorizes curl to make redirections
# $1 takes the first argument given to the script



# we could also use : curl -L -s -I $1 | grep -E "Location:" | cut -d " " -f 2
# but it will give us all url redirected and not the final redirection

# -I specifies to curl that we need only the matadata, it will send the request HEAD insted of GET, isn't compatible with all servers
# -E tells to grep that we will use a string regex (it's if needed)
# -d specifies the separator needed to be recognized by cut
# -f indicates which element we want to see, in this case is the 2nd element which is the element after the first delimiters because the first is the one before
