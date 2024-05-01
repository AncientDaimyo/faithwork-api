# faithwork-api

## MODULE PRODUCT

### GET PRODUCTS

route /api/product/get-products

method GET

response

```json
{
   {
      "uuid":  uuid,
      "name":  product name,
      "cost":  cost,
      "image": base64 code of image,
   },
   {
      ...
   },
   {
      ...
   },
   ...
}
```

### GET PRODUCT BY ULID

route /api/product/get-product-by/{uuid}

method GET

response

```json

{
   "uuid":  uuid,
   "name":  name,
   "cost":  cost,
   "image": base64,
   "sizes": {
      "size": size,
      "size": size,
      "size": size
   },
   "description": {
      "print":    print,
      "density":  density,
      "compound": compound
   }
}
```


## MODULE CHECKOUT

### MAKE ORDER

route /api/checkout/make-order

method POST

body

```json
{
   "customer":{
      "name":        name,
      "surname":     surname,
      "patronymic":  patronymic,
      "email":       email,
      "telephone":   phone number,
      "address":{
         "city":        city,
         "street":      street,
         "house":       house,
         "apartment":   apartment
      }
   },
   "cart":{
      {
         "uuid":     uuid,
         "size":     size,
         "amount":   amount
      },
      ...
   }
}
```