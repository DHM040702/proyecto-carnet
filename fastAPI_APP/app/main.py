from fastapi import FastAPI
from app.routers import validacion

app = FastAPI(title="Servicio de Validación Facial")

app.include_router(
    validacion.router,
    prefix="/validacion",
    tags=["Validación Facial"]
)
