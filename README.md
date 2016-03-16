bestlog
======================

Tool to create centralised dynamic logs for scripts, useful if you want to know if a script executes it's statement.

#### Usage:

Curl at the target URL with the hostname and log name set as a GET request.

Example:

    curl -s "https://arthur.serverhostna.me/bestlog/?hostname=$(hostname)&log=example"

Logs are stored in the logs directory.

    cat logs/example.log
    1458152103 2016-03-16_18:15:03 marvin.serverhostna.me

#### Example script usage:

    #!/bin/bash
    #check for stuck puppet locks.
    
    if $(test -e /var/log/syslog); then
    
        SYSLOG="/var/log/syslog"
    
    elif $(test -e /var/log/messages); then
    
        SYSLOG="/var/log/messages"
    
    fi
    
    LOCKCOUNT=$(grep puppet-agent ${SYSLOG} | tail -n 10 | grep "lock exists" | wc -l)
    
    if [[ ${LOCKCOUNT} -gt 2 ]]; then
    
        rm -f /var/lib/puppet/state/agent_catalog_run.lock
        /etc/init.d/puppet restart
        curl -s "https://arthur.serverhostna.me/bestlog/?hostname=$(hostname)&log=puppetlock"
    
    fi
