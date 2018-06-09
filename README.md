# 🚀 BEAR.Sunday + Swoole 🚀

## Installation

### PECL   

Install [Swoole](https://www.swoole.co.uk/#get-started) 
    
### PHP
    composer install

## Usage

### Run swoole server

    php bin/swoole.php

## Benchmark with [wrk](https://github.com/wg/wrk)

    wrk http://127.0.0.1:8080/

### Apache

```
Running 10s test @ http://127.0.0.1:80/
  2 threads and 10 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    31.21ms   32.48ms 236.81ms   85.16%
    Req/Sec   214.98     53.64   380.00     65.50%
  4303 requests in 10.06s, 0.87MB read
Requests/sec:    427.93
Transfer/sec:     89.09KB
```

### Swoole

```
Running 10s test @ http://127.0.0.1:8080/
  2 threads and 10 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   384.26us  237.28us  13.40ms   94.43%
    Req/Sec    12.90k   539.12    13.60k    85.15%
  259243 requests in 10.10s, 49.45MB read
Requests/sec:  25668.10
Transfer/sec:      4.90MB
```

## Benchmark with ab

    ab -n 50000 -c 10 -k http://127.0.0.1:8080/

### Apache

```
Server Software:        Apache/2.4.33
Server Hostname:        127.0.0.1
Server Port:            80

Document Path:          /
Document Length:        40 bytes

Concurrency Level:      10
Time taken for tests:   114.645 seconds
Complete requests:      50000
Failed requests:        0
Keep-Alive requests:    49510
Total transferred:      13378450 bytes
HTML transferred:       2000000 bytes
Requests per second:    436.13 [#/sec] (mean)
Time per request:       22.929 [ms] (mean)
Time per request:       2.293 [ms] (mean, across all concurrent requests)
Transfer rate:          113.96 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.0      0       0
Processing:     9   23  30.4      9     260
Waiting:        9   23  30.3      9     260
Total:          9   23  30.4      9     260

Percentage of the requests served within a certain time (ms)
  50%      9
  66%      9
  75%     21
  80%     31
  90%     61
  95%     90
  98%    125
  99%    152
 100%    260 (longest request)
```

### Swoole

```
Server Software:        swoole-http-server
Server Hostname:        127.0.0.1
Server Port:            8080

Document Path:          /
Document Length:        40 bytes

Concurrency Level:      10
Time taken for tests:   2.001 seconds
Complete requests:      50000
Failed requests:        0
Keep-Alive requests:    50000
Total transferred:      10000000 bytes
HTML transferred:       2000000 bytes
Requests per second:    24991.74 [#/sec] (mean)
Time per request:       0.400 [ms] (mean)
Time per request:       0.040 [ms] (mean, across all concurrent requests)
Transfer rate:          4881.20 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.0      0       0
Processing:     0    0   0.2      0      11
Waiting:        0    0   0.2      0      11
Total:          0    0   0.2      0      11

Percentage of the requests served within a certain time (ms)
  50%      0
  66%      0
  75%      0
  80%      0
  90%      1
  95%      1
  98%      1
  99%      1
 100%     11 (longest request)
```

# How to apply in your project ?

Copy `bin/swoole.php` and modify application name and context.
See more in commit log. Please give me feedback.