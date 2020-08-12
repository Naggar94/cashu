---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Hotel Explore


APIs fetching hotels from different providers
<!-- START_5ed24fcefc3cd3c1514981d2343645e9 -->
## api/our-hotels
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/our-hotels" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"page":3,"city":"CAI.","from":"2020-01-15","to":"2020-08-20","adults_number":3}'

```

```javascript
const url = new URL(
    "http://localhost/api/our-hotels"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "page": 3,
    "city": "CAI.",
    "from": "2020-01-15",
    "to": "2020-08-20",
    "adults_number": 3
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "hotelName": "Hotel 1",
    "fare": 152.5,
    "amenities": [
        "Air Conditioner",
        "TV",
        "Playstation",
        "Play Ground"
    ],
    "provider": "TopHotels"
}
```

### HTTP Request
`GET api/our-hotels`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `page` | integer |  optional  | optional The page of search by default it is set to 1.
        `city` | string |  optional  | optional IATA code of the city.
        `from` | date |  optional  | optional starting date of availability of Hotel.
        `to` | date |  optional  | optional end date of availability of Hotel.
        `adults_number` | integer |  optional  | optional The count of people desired for reservation.
    
<!-- END_5ed24fcefc3cd3c1514981d2343645e9 -->

<!-- START_13ff88a46b8e637a12ef9f26c4a6418b -->
## api/best-hotels
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/best-hotels" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"page":3,"city":"CAI.","from":"2020-01-15","to":"2020-08-20","numberOfAdults":3}'

```

```javascript
const url = new URL(
    "http://localhost/api/best-hotels"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "page": 3,
    "city": "CAI.",
    "from": "2020-01-15",
    "to": "2020-08-20",
    "numberOfAdults": 3
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "hotel": "Hotel 1",
    "hotelRate": 3,
    "roomAmenities": [
        "Air Conditioner",
        "TV",
        "Playstation",
        "Play Ground"
    ],
    "hotelFare": 145.5
}
```

### HTTP Request
`GET api/best-hotels`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `page` | integer |  optional  | optional The page of search by default it is set to 1.
        `city` | string |  optional  | optional IATA code of the city.
        `from` | date |  optional  | optional starting date of availability of Hotel.
        `to` | date |  optional  | optional end date of availability of Hotel.
        `numberOfAdults` | integer |  optional  | optional The count of people desired for reservation.
    
<!-- END_13ff88a46b8e637a12ef9f26c4a6418b -->

<!-- START_c4597bcafe18964d13c5bc7741ee0fd2 -->
## api/top-hotels
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/top-hotels" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"page":3,"city":"CAI.","from":"2020-01-15","to":"2020-08-20","adultsCount":3}'

```

```javascript
const url = new URL(
    "http://localhost/api/top-hotels"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "page": 3,
    "city": "CAI.",
    "from": "2020-01-15",
    "to": "2020-08-20",
    "adultsCount": 3
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "hotelName": "Hotel 1",
    "rate": "***",
    "roomAmenities": [
        "Air Conditioner",
        "TV",
        "Playstation",
        "Play Ground"
    ],
    "price": 145.5
}
```

### HTTP Request
`GET api/top-hotels`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `page` | integer |  optional  | optional The page of search by default it is set to 1.
        `city` | string |  optional  | optional IATA code of the city.
        `from` | date |  optional  | optional starting date of availability of Hotel.
        `to` | date |  optional  | optional end date of availability of Hotel.
        `adultsCount` | integer |  optional  | optional The count of people desired for reservation.
    
<!-- END_c4597bcafe18964d13c5bc7741ee0fd2 -->


