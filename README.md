# Surface - PHP Environment Manager

## Config

### all()
### get($key, $process = null)
### from($extension)
### set($key, $value)
### restore($key)
### load($path, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
### parse($ini, $process_sections = false, $scanner_mode = INI_SCANNER_NORMAL)
### source()
### included()

## Connection

### ignoreAbort($mode)
### isAbortIgnored()
### getStatus()
### isNormal()
### isTimeout()
### isAborted()
### ip($real = false)
### isSecure()
### port()
### remotePort()
### host()

## Memory

### used($real_usage = false, $humanize = false)
### peak($real_usage = false, $humanize = false)
### limit($value = null)

## Process;

### user()
### uid()
### gid()
### pid()
### inode()
### timeout($sec = null)
### sleep($msec)
### started($format = null)
### uptime()

## Scope;

## Storage

## System

## Time
