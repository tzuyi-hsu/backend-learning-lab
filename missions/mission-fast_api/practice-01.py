@app.get("/products")
def get_products():
    return {
    "status": "success",
    "product": "Notebook",
    "price": 50000
    }


@app.get("/users")
def get_users():
    return{
        "status":"success",
        "count":2,
        "users":[
            {
                "id":1,
                "name":"Amy"
            },
            {
                "id":2,
                "name":"Bob"
            }
        ]
    }

@app.get("/users/{user_id}")
def get_users(user_id:int):
    return{
    "user_id": user_id,
    "message": "找到使用者"
    }

@app.get("/products/{product_id}discount={discount}")
def get_product(product_id:int , discount:int):
    return {
        "product_id":product_id,
        "discount": discount
    }

@app.get("/users/{user_id}?active=1")
def get_users(user_id:int , actice:int)
    return{
        "user_id":user_id,
        "active":actice
    }

@app.get("/products/{product_id}")
def get_product(product_id:int , keyword: str | None = None ,limit:int = 20):
    return{
        "product_id":product_id,
        "keyword":keyword,
        "limit":limit
    }

from fastapi import FastAPI
from pydantic import BaseModel

app = FastAPI()

class Product(BaseModel):
    name: str
    price: int
    stock: int


@app.post("/products")
def create_product(product: Product):
    return {
        "name": product.name,
        "price": product.price,
        "stock": product.stock
    }

class Product(BaseModel):
    name:str
    price:int

@app.post("/products")
def creat_product(product:Product):
    return{
        "name":product.name,
        "price":product.price
    }

class Product(BaseModel):
    name:str
    price:int
    description: str | None = None
    stock:int = 0

class Product(BaseModel):
    name:str = Field(min_length=3,max_length=50)
    price:int = Field(gt=0)
    stock:int = Field(0, ge=0)


#03獨立題

class UserRegister(BaseModel):
    username:str = Field(min_length = 3 ,max_length =20)
    age:int = Field(ge=18)
    bio:str|None = Field(None ,max_length = 100)
    score:float = Field(0.0,ge=0,le=100)
