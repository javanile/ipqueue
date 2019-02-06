# ipqueue

[![StyleCI](https://github.styleci.io/repos/158704688/shield?branch=master)](https://github.styleci.io/repos/158704688)
[![Build Status](https://travis-ci.org/javanile/ipqueue.svg?branch=master)](https://travis-ci.org/javanile/ipqueue)
[![codecov](https://codecov.io/gh/javanile/ipqueue/branch/master/graph/badge.svg)](https://codecov.io/gh/javanile/ipqueue)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/00bc294fe3ae4bca8c74d6d6530f3d54)](https://app.codacy.com/app/francescobianco/ipqueue?utm_source=github.com&utm_medium=referral&utm_content=javanile/ipqueue&utm_campaign=Badge_Grade_Dashboard)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Enable your project to use a service discovery. With IpQueue you can create scripts for service registration and service information retrieval in a smart way without pain. IpQueue uses a simple HTTP API layer easily integrable on every environment, you can use a cURL syntax to interact with Docker, Kubernates, Jenkins, Travis CI, etc...

## Get started

**Register your service** *(call from service machine or container)*
```bash
$ curl -XPOST <service-name>.ipqueue.com
```

**Retrieve information of service** *(call from dependants system)*
```bash
$ curl -s <service-name>.ipqueue.com
```

`<services-name>` can be: 
  - *acme-crm-prod-mysql*, 
  - *com-mycorp-uat-nginx*, 
  - *org-care-dev-apache*, 
  - etc...


Update Documentation

docker-compose up docs

## HTTP Methods

| Method    | Function                             |
| --------- | ------------------------------------ |
| `GET`     | Retrieve information about a service |
| `HEAD`    | _Not used_                           |
| `POST`    | Register service instance            |
| `PUT`     | Store service variables and protect  |
| `DELETE`  | Delete service of remove protection  |
| `CONNECT` | _Not used_                           |
| `OPTIONS` | _Not used_                           |
| `TRACE`   | _Not used_                           |

## HTTP Headers

| Header    | Function                             |
| --------- | ------------------------------------ |
| `ENV`     | Set specific environment             |
